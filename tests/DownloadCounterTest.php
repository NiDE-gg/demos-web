<?php

namespace Tests;

use DownloadCounter;
use PDO;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/downloads.php';

class DownloadCounterTest extends TestCase
{
    private string $tmpDir;
    private string $dbPath;

    protected function setUp(): void
    {
        $this->tmpDir = sys_get_temp_dir() . '/demos-web-test-' . uniqid();
        mkdir($this->tmpDir, 0777, true);
        $this->dbPath = $this->tmpDir . '/downloads.sqlite';

        DownloadCounter::useConnection(new PDO('sqlite:' . $this->dbPath));
    }

    protected function tearDown(): void
    {
        // Release the file handle so the temp dir can be removed on Windows.
        DownloadCounter::useConnection(new PDO('sqlite::memory:'));

        foreach (glob($this->tmpDir . '/*') ?: [] as $file) {
            unlink($file);
        }
        rmdir($this->tmpDir);
    }

    public function testIncrementReturnsRunningCount(): void
    {
        $this->assertSame(1, DownloadCounter::increment('css_ze', 'a.dem'));
        $this->assertSame(2, DownloadCounter::increment('css_ze', 'a.dem'));
        $this->assertSame(['a.dem' => 2], DownloadCounter::getCounts('css_ze'));
    }

    public function testPruneRemovesOnlyMissingFilesOfThatServer(): void
    {
        DownloadCounter::increment('css_ze', 'kept.dem');
        DownloadCounter::increment('css_ze', 'gone.dem');
        DownloadCounter::increment('css_zr', 'gone.dem');

        DownloadCounter::prune('css_ze', ['kept.dem', 'new.dem']);

        $this->assertSame(['kept.dem' => 1], DownloadCounter::getCounts('css_ze'));
        $this->assertSame(['gone.dem' => 1], DownloadCounter::getCounts('css_zr'));
    }

    public function testPruneWithNoFilesClearsTheServer(): void
    {
        DownloadCounter::increment('css_ze', 'a.dem');
        DownloadCounter::increment('css_ze', 'b.dem');

        DownloadCounter::prune('css_ze', []);

        $this->assertSame([], DownloadCounter::getCounts('css_ze'));
    }

    public function testPruneWithNothingStaleDoesNotNeedTheWriteLock(): void
    {
        DownloadCounter::increment('css_ze', 'a.dem');

        // Another connection holds the write lock (e.g. a concurrent download).
        $locker = new PDO('sqlite:' . $this->dbPath);
        $locker->exec('BEGIN IMMEDIATE');

        $reader = new PDO('sqlite:' . $this->dbPath, null, null, [PDO::ATTR_TIMEOUT => 0]);
        DownloadCounter::useConnection($reader);

        DownloadCounter::prune('css_ze', ['a.dem']);
        $this->assertSame(['a.dem' => 1], DownloadCounter::getCounts('css_ze'));

        $locker->exec('ROLLBACK');
    }
}
