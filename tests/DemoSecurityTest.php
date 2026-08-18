<?php

namespace Tests;

use DemoSecurity;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/security.php';

class DemoSecurityTest extends TestCase
{
    private string $tmpDir;

    protected function setUp(): void
    {
        $this->tmpDir = sys_get_temp_dir() . '/demos-web-test-' . uniqid();
        mkdir($this->tmpDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->tmpDir);
    }

    private function removeDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        foreach (scandir($dir) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $path = $dir . '/' . $entry;
            is_dir($path) ? $this->removeDirectory($path) : unlink($path);
        }

        rmdir($dir);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function validServerProvider(): array
    {
        return [
            'css_ze' => ['css_ze'],
            'css_zr' => ['css_zr'],
        ];
    }

    #[DataProvider('validServerProvider')]
    public function testValidateServerAcceptsWhitelistedServers(string $server): void
    {
        $this->assertSame($server, DemoSecurity::validateServer($server));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidServerProvider(): array
    {
        return [
            'not whitelisted' => ['css_unknown'],
            'empty' => [''],
            'path traversal' => ['../css_ze'],
            'special characters' => ['css_ze;rm -rf'],
            'spaces' => ['css ze'],
        ];
    }

    #[DataProvider('invalidServerProvider')]
    public function testValidateServerRejectsInvalidInput(string $server): void
    {
        $this->assertFalse(DemoSecurity::validateServer($server));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function validFilenameProvider(): array
    {
        return [
            'dem file' => ['auto-20240115-153045-mapname.dem'],
            'bz2 file' => ['auto-20240115-153045-mapname.dem.bz2'],
            'map with underscores and dashes' => ['auto-20240115-153045-ze_map-v2.dem'],
            'legacy @ token' => ['auto-20240115-153045-ze_map@1.dem'],
        ];
    }

    #[DataProvider('validFilenameProvider')]
    public function testSanitizeFilenameAcceptsValidNames(string $filename): void
    {
        $this->assertSame($filename, DemoSecurity::sanitizeFilename($filename));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidFilenameProvider(): array
    {
        return [
            'empty' => [''],
            'missing prefix' => ['20240115-153045-mapname.dem'],
            'wrong extension' => ['auto-20240115-153045-mapname.txt'],
            'short date' => ['auto-2024015-153045-mapname.dem'],
            'path traversal' => ['../../etc/passwd'],
            'null byte' => ["auto-20240115-153045-mapname.dem\0.php"],
            'command injection chars' => ['auto-20240115-153045-map;rm -rf.dem'],
        ];
    }

    #[DataProvider('invalidFilenameProvider')]
    public function testSanitizeFilenameRejectsInvalidNames(string $filename): void
    {
        $this->assertFalse(DemoSecurity::sanitizeFilename($filename));
    }

    public function testSanitizeFilenameStripsDirectoryComponents(): void
    {
        $result = DemoSecurity::sanitizeFilename('../../auto-20240115-153045-mapname.dem');

        // basename() strips the traversal, leaving a valid filename.
        $this->assertSame('auto-20240115-153045-mapname.dem', $result);
    }

    public function testEscapeHtmlEscapesSpecialCharacters(): void
    {
        $result = DemoSecurity::escapeHtml('<script>alert("xss")</script>');

        $this->assertSame('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', $result);
    }

    public function testGetAllowedServersReturnsWhitelist(): void
    {
        $servers = DemoSecurity::getAllowedServers();

        $this->assertArrayHasKey('css_ze', $servers);
        $this->assertArrayHasKey('css_zr', $servers);
    }

    public function testValidateFilePathAcceptsExistingWhitelistedFile(): void
    {
        $filename = 'auto-20240115-153045-mapname.dem';
        $demosDir = $this->tmpDir . '/css_ze/demos';
        mkdir($demosDir, 0777, true);
        file_put_contents($demosDir . '/' . $filename, 'fake demo content');

        $result = DemoSecurity::validateFilePath('css_ze', $filename, $this->tmpDir);

        $this->assertSame(realpath($demosDir . '/' . $filename), $result);
    }

    public function testValidateFilePathRejectsMissingFile(): void
    {
        mkdir($this->tmpDir . '/css_ze/demos', 0777, true);

        $result = DemoSecurity::validateFilePath('css_ze', 'auto-20240115-153045-mapname.dem', $this->tmpDir);

        $this->assertFalse($result);
    }

    public function testValidateFilePathRejectsPathTraversalOutsideDemosDir(): void
    {
        mkdir($this->tmpDir . '/css_ze/demos', 0777, true);
        file_put_contents($this->tmpDir . '/secret.txt', 'should not be reachable');

        $result = DemoSecurity::validateFilePath(
            'css_ze',
            '..%2f..%2fsecret.txt',
            $this->tmpDir
        );

        $this->assertFalse($result);
    }

    public function testValidateFilePathRejectsUnknownServer(): void
    {
        $result = DemoSecurity::validateFilePath(
            'unknown_server',
            'auto-20240115-153045-mapname.dem',
            $this->tmpDir
        );

        $this->assertFalse($result);
    }
}
