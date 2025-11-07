<?php
// PostgreSQL connection parameters
$host = "localhost";
$port = "5432";
$dbname = "upsa_party";
$user = "postgres";
$password = "12345";

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error: Unable to connect to the database.");
}
?>
