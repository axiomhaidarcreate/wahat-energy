<?php
/**
 * Temporary debug file - DELETE AFTER USE!
 * Shows the last error from Laravel log file
 * Access: https://yourdomain.com/debug-log.php?key=wahat2026
 */

// Simple security key - change this!
if (($_GET['key'] ?? '') !== 'wahat2026') {
    http_response_code(403);
    echo 'Access Denied';
    exit;
}

$logFile = __DIR__ . '/../storage/logs/laravel.log';

if (!file_exists($logFile)) {
    echo '<h2>No log file found</h2>';
    exit;
}

// Get last 5000 characters of log
$content = file_get_contents($logFile);
$lastPart = substr($content, -5000);

echo '<html dir="ltr"><head><title>Debug Log</title><style>
body { font-family: monospace; background: #1a1a2e; color: #e0e0e0; padding: 20px; }
pre { background: #16213e; padding: 20px; border-radius: 8px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; border: 1px solid #0f3460; }
h2 { color: #e94560; }
.warning { background: #e94560; color: white; padding: 10px 20px; border-radius: 4px; display: inline-block; margin-bottom: 20px; }
</style></head><body>';
echo '<div class="warning">⚠️ DELETE THIS FILE AFTER DEBUGGING!</div>';
echo '<h2>Last Laravel Log Entries:</h2>';
echo '<pre>' . htmlspecialchars($lastPart) . '</pre>';

// Also check PHP info
echo '<h2>PHP Info:</h2>';
echo '<pre>';
echo 'PHP Version: ' . phpversion() . "\n";
echo 'Storage writable: ' . (is_writable(__DIR__ . '/../storage') ? 'YES' : 'NO') . "\n";
echo 'Storage/app/public writable: ' . (is_writable(__DIR__ . '/../storage/app/public') ? 'YES' : 'NO') . "\n";
echo 'Storage link exists: ' . (is_link(__DIR__ . '/storage') || is_dir(__DIR__ . '/storage') ? 'YES' : 'NO') . "\n";
echo 'Bootstrap/cache writable: ' . (is_writable(__DIR__ . '/../bootstrap/cache') ? 'YES' : 'NO') . "\n";

// Check .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $env = file_get_contents($envFile);
    preg_match('/APP_DEBUG=(.*)/', $env, $matches);
    echo 'APP_DEBUG: ' . ($matches[1] ?? 'NOT SET') . "\n";
    preg_match('/APP_ENV=(.*)/', $env, $matches);
    echo 'APP_ENV: ' . ($matches[1] ?? 'NOT SET') . "\n";
    preg_match('/FILESYSTEM_DISK=(.*)/', $env, $matches);
    echo 'FILESYSTEM_DISK: ' . ($matches[1] ?? 'NOT SET') . "\n";
}
echo '</pre>';
echo '</body></html>';
