<?php
// Use environment variable if available (for Heroku or other setups)
$databaseUrl = getenv("DATABASE_URL");

if ($databaseUrl) {
    $parts = parse_url($databaseUrl);
    $host = $parts['host'] ?? 'localhost';
    $port = $parts['port'] ?? '5432';
    $dbname = isset($parts['path']) ? ltrim($parts['path'], '/') : 'upsa_party';
    $user = $parts['user'] ?? 'postgres';
    $password = $parts['pass'] ?? '';
} else {
    // Local default values
    $host = 'localhost';
    $port = '5432';
    $dbname = 'upsa_party';
    $user = 'postgres';
    $password = '';
}

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
