<?php
$databaseUrl = getenv("DATABASE_URL");

if (!$databaseUrl) {
    die("Error: DATABASE_URL environment variable is not set.");
}

$parts = parse_url($databaseUrl);

$host     = $parts['host'];
$port     = $parts['port'] ?? 5432;
$dbname   = ltrim($parts['path'], '/');
$user     = $parts['user'];
$password = $parts['pass'];

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error: Unable to connect to the database. " . pg_last_error());
}
?>
