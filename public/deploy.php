<?php

$secret = 'lemari_peduli_deploy_2026';
if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    die('Forbidden: Invalid Key');
}

header('Content-Type: text/plain; charset=utf-8');
ini_set('max_execution_time', 600);
set_time_limit(600);

echo "========================================\n";
echo "LEMARI PEDULI - AAPANEL DEPLOYMENT RUNNER\n";
echo "========================================\n\n";

$dir = dirname(__DIR__);
chdir($dir);
echo "Project root: " . $dir . "\n";
echo "PHP Version: " . PHP_VERSION . "\n";

// 1. Setup .env
echo "\n--- 1. Setting up .env ---\n";
if (!file_exists($dir . '/.env')) {
    if (file_exists($dir . '/.env.example')) {
        $env = file_get_contents($dir . '/.env.example');
    } else {
        $env = "APP_NAME=\"Lemari Peduli\"\nAPP_ENV=production\nAPP_KEY=\nAPP_DEBUG=false\nAPP_URL=https://a3.athafa.cloud\n\nDB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=sql_a3_athafa_cloud\nDB_USERNAME=sql_a3_athafa_cloud\nDB_PASSWORD=ab5ab5b40fa538\n\nSESSION_DRIVER=database\nCACHE_STORE=database\nQUEUE_CONNECTION=database\n";
    }

    $env = preg_replace('/APP_NAME=.*/', 'APP_NAME="Lemari Peduli"', $env);
    $env = preg_replace('/APP_ENV=.*/', 'APP_ENV=production', $env);
    $env = preg_replace('/APP_DEBUG=.*/', 'APP_DEBUG=false', $env);
    $env = preg_replace('/APP_URL=.*/', 'APP_URL=https://a3.athafa.cloud', $env);
    $env = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=mysql', $env);
    $env = preg_replace('/DB_HOST=.*/', 'DB_HOST=127.0.0.1', $env);
    $env = preg_replace('/DB_PORT=.*/', 'DB_PORT=3306', $env);
    $env = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=sql_a3_athafa_cloud', $env);
    $env = preg_replace('/DB_USERNAME=.*/', 'DB_USERNAME=sql_a3_athafa_cloud', $env);
    $env = preg_replace('/DB_PASSWORD=.*/', 'DB_PASSWORD=ab5ab5b40fa538', $env);

    file_put_contents($dir . '/.env', $env);
    echo "Created .env with database credentials: OK\n";
} else {
    echo ".env already exists.\n";
}

// 2. Set environment paths
putenv('COMPOSER_ALLOW_SUPERUSER=1');
putenv('COMPOSER_HOME=/tmp/.composer');
$currentPath = getenv('PATH') ?: '';
putenv('PATH=/www/server/php/85/bin:/www/server/php/84/bin:/usr/local/bin:/usr/bin:/bin:' . $currentPath);

echo "\n--- 2. Checking Composer & Dependencies ---\n";
echo "which composer: " . trim((string)shell_exec('which composer 2>&1')) . "\n";
echo "which php: " . trim((string)shell_exec('which php 2>&1')) . "\n";

if (!file_exists($dir . '/vendor/autoload.php')) {
    echo "Running composer install...\n";
    $output = shell_exec('composer install --no-dev --optimize-autoloader --no-interaction 2>&1');
    echo $output . "\n";
} else {
    echo "vendor/autoload.php already exists.\n";
}

// 3. Run artisan commands
echo "\n--- 3. Running Artisan Commands ---\n";
echo "Key generate:\n";
echo shell_exec('php artisan key:generate --force 2>&1') . "\n";

echo "Storage link:\n";
echo shell_exec('php artisan storage:link 2>&1') . "\n";

echo "Migrate & Seed:\n";
echo shell_exec('php artisan migrate:fresh --seed --force 2>&1') . "\n";

echo "Cache config & route:\n";
echo shell_exec('php artisan config:cache 2>&1') . "\n";
echo shell_exec('php artisan route:cache 2>&1') . "\n";
echo shell_exec('php artisan view:cache 2>&1') . "\n";

// 4. Permissions
echo "\n--- 4. Setting Permissions ---\n";
echo shell_exec('chmod -R 775 ' . escapeshellarg($dir . '/storage') . ' ' . escapeshellarg($dir . '/bootstrap/cache') . ' 2>&1') . "\n";

echo "\n========================================\n";
echo "DEPLOYMENT COMPLETE!\n";
echo "========================================\n";
