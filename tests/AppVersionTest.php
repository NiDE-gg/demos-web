<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/version.php';

class AppVersionTest extends TestCase
{
    private string $tmpDir;

    protected function setUp(): void
    {
        $this->tmpDir = sys_get_temp_dir() . '/demos-web-version-' . uniqid();
        mkdir($this->tmpDir . '/refs/heads', 0777, true);
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

    public function testResolvesLooseRef(): void
    {
        $hash = '1234567890abcdef1234567890abcdef12345678';
        file_put_contents($this->tmpDir . '/HEAD', "ref: refs/heads/main\n");
        file_put_contents($this->tmpDir . '/refs/heads/main', $hash . "\n");

        $this->assertSame($hash, resolveCommitFromGit($this->tmpDir));
    }

    public function testResolvesPackedRef(): void
    {
        $hash = 'abcdefabcdefabcdefabcdefabcdefabcdefabcd';
        file_put_contents($this->tmpDir . '/HEAD', "ref: refs/heads/main\n");
        file_put_contents(
            $this->tmpDir . '/packed-refs',
            "# pack-refs with: peeled fully-peeled sorted\n" .
            "0000000000000000000000000000000000000000 refs/heads/other\n" .
            $hash . " refs/heads/main\n"
        );

        $this->assertSame($hash, resolveCommitFromGit($this->tmpDir));
    }

    public function testResolvesDetachedHead(): void
    {
        $hash = 'FEDCBA9876543210fedcba9876543210fedcba98';
        file_put_contents($this->tmpDir . '/HEAD', $hash . "\n");

        $this->assertSame(strtolower($hash), resolveCommitFromGit($this->tmpDir));
    }

    public function testResolvesGitDirFile(): void
    {
        $hash = '0f1e2d3c4b5a69788796a5b4c3d2e1f001234567';
        file_put_contents($this->tmpDir . '/HEAD', $hash . "\n");

        $worktree = $this->tmpDir . '-worktree';
        mkdir($worktree, 0777, true);
        file_put_contents($worktree . '/.git', 'gitdir: ' . $this->tmpDir . "\n");

        try {
            $this->assertSame($hash, resolveCommitFromGit($worktree . '/.git'));
        } finally {
            $this->removeDirectory($worktree);
        }
    }

    public function testReturnsNullWhenNothingResolvable(): void
    {
        $this->assertNull(resolveCommitFromGit($this->tmpDir . '/missing'));
        $this->assertNull(resolveCommitFromVersionFile($this->tmpDir . '/VERSION'));
    }

    public function testVersionFileIsValidated(): void
    {
        $path = $this->tmpDir . '/VERSION';

        file_put_contents($path, "not-a-hash\n");
        $this->assertNull(resolveCommitFromVersionFile($path));

        file_put_contents($path, "  deadbeef  \n");
        $this->assertSame('deadbeef', resolveCommitFromVersionFile($path));
    }

    public function testEnvironmentOverride(): void
    {
        putenv('APP_COMMIT=CAFEBABE');
        try {
            $this->assertSame('cafebabe', resolveCommitFromEnvironment());
        } finally {
            putenv('APP_COMMIT');
        }
    }
}
