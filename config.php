<?php

function app_env(string $key, ?string $default = null): ?string
{
    $value = getenv($key);

    if ($value === false || $value === '') {
        return $default;
    }

    return $value;
}

function get_db_config(): array
{
    $config = [
        'host' => app_env('DB_HOST', '127.0.0.1'),
        'port' => app_env('DB_PORT', '3306'),
        'username' => app_env('DB_USERNAME', 'root'),
        'password' => app_env('DB_PASSWORD', ''),
        'database' => app_env('DB_DATABASE', 'smc'),
    ];

    $databaseUrl = app_env('MYSQL_URL', app_env('DATABASE_URL', ''));
    if ($databaseUrl) {
        $parts = parse_url($databaseUrl);

        if ($parts !== false) {
            if (!empty($parts['host'])) {
                $config['host'] = $parts['host'];
            }
            if (!empty($parts['port'])) {
                $config['port'] = (string) $parts['port'];
            }
            if (!empty($parts['user'])) {
                $config['username'] = $parts['user'];
            }
            if (array_key_exists('pass', $parts)) {
                $config['password'] = $parts['pass'];
            }
            if (!empty($parts['path'])) {
                $config['database'] = ltrim($parts['path'], '/');
            }
        }
    }

    return [
        'host' => app_env('MYSQLHOST', $config['host']),
        'port' => app_env('MYSQLPORT', $config['port']),
        'username' => app_env('MYSQLUSER', $config['username']),
        'password' => app_env('MYSQLPASSWORD', $config['password']),
        'database' => app_env('MYSQLDATABASE', $config['database']),
    ];
}

function create_db_connection(): mysqli
{
    $config = get_db_config();
    $connection = mysqli_init();

    if ($connection === false) {
        die('Database initialization failed.');
    }

    mysqli_options($connection, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

    $connected = mysqli_real_connect(
        $connection,
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database'],
        (int) $config['port']
    );

    if (!$connected) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    mysqli_set_charset($connection, 'utf8mb4');

    return $connection;
}

function get_recaptcha_site_key(): string
{
    return app_env('RECAPTCHA_SITE_KEY', '') ?? '';
}

function get_recaptcha_secret_key(): string
{
    return app_env('RECAPTCHA_SECRET_KEY', '') ?? '';
}

function verify_recaptcha_response(string $captchaResponse, string $remoteIp = ''): bool
{
    if ($captchaResponse === '') {
        return false;
    }

    $secretKey = get_recaptcha_secret_key();
    if ($secretKey === '') {
        return false;
    }

    $postData = [
        'secret' => $secretKey,
        'response' => $captchaResponse,
    ];

    if ($remoteIp !== '') {
        $postData['remoteip'] = $remoteIp;
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($postData),
            'timeout' => 10,
        ],
    ]);

    $response = @file_get_contents(
        'https://www.google.com/recaptcha/api/siteverify',
        false,
        $context
    );

    if ($response === false) {
        return false;
    }

    $decoded = json_decode($response, true);

    return isset($decoded['success']) && $decoded['success'] === true;
}
