<?php
/**
 * SQLite-backed download counter for demo files.
 * Self-cleans: rows for files no longer on disk are pruned whenever
 * the owning server's demo list is scanned.
 */

class DownloadCounter
{
    private static ?PDO $pdo = null;

    private static function db(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0770, true);
        }

        $pdo = new PDO('sqlite:' . $dataDir . '/downloads.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('PRAGMA journal_mode = WAL');
        $pdo->exec('PRAGMA synchronous = NORMAL');
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS downloads (
                server TEXT NOT NULL,
                filename TEXT NOT NULL,
                count INTEGER NOT NULL DEFAULT 0,
                PRIMARY KEY (server, filename)
            )'
        );

        self::$pdo = $pdo;
        return $pdo;
    }

    /**
     * Remove counters for files that no longer exist for this server.
     * Call this whenever the current file list for a server is known
     * (e.g. during directory scan), so cleanup rides along for free.
     *
     * @param string $server
     * @param string[] $existingFilenames
     */
    public static function prune(string $server, array $existingFilenames): void
    {
        $pdo = self::db();

        if (empty($existingFilenames)) {
            $stmt = $pdo->prepare('DELETE FROM downloads WHERE server = :server');
            $stmt->execute([':server' => $server]);
            return;
        }

        $placeholders = implode(',', array_fill(0, count($existingFilenames), '?'));
        $stmt = $pdo->prepare(
            "DELETE FROM downloads WHERE server = ? AND filename NOT IN ($placeholders)"
        );
        $stmt->execute(array_merge([$server], $existingFilenames));
    }

    /**
     * Atomically increment and return the new count for a file.
     */
    public static function increment(string $server, string $filename): int
    {
        $pdo = self::db();

        $stmt = $pdo->prepare(
            'INSERT INTO downloads (server, filename, count) VALUES (:server, :filename, 1)
             ON CONFLICT(server, filename) DO UPDATE SET count = count + 1'
        );
        $stmt->execute([':server' => $server, ':filename' => $filename]);

        $stmt = $pdo->prepare('SELECT count FROM downloads WHERE server = :server AND filename = :filename');
        $stmt->execute([':server' => $server, ':filename' => $filename]);

        return (int) $stmt->fetchColumn();
    }

    /**
     * Fetch filename => count map for a server in a single query.
     *
     * @return array<string, int>
     */
    public static function getCounts(string $server): array
    {
        $pdo = self::db();

        $stmt = $pdo->prepare('SELECT filename, count FROM downloads WHERE server = :server');
        $stmt->execute([':server' => $server]);

        return array_map('intval', $stmt->fetchAll(PDO::FETCH_KEY_PAIR));
    }
}
?>
