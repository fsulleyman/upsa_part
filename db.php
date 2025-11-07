<?php
// Get DATABASE_URL from environment
$databaseUrl = getenv("DATABASE_URL");

if (!$databaseUrl) {
    die("DATABASE_URL is not set in the environment!");
}

// Parse DATABASE_URL
$parts = parse_url($databaseUrl);

$host = $parts['host'];
$port = $parts['port'];
$dbname = ltrim($parts['path'], '/');
$user = $parts['user'];
$password = $parts['pass'];

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Database connection failed: " . pg_last_error());
}

// Optional for debugging:
// echo "✅ Connected to database '$dbname' successfully!<br>";
?>
