<?php
// Include database connection
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event = $_POST['event'];
    $price = $_POST['price'];

    // Explicit schema to avoid errors
    $query = "INSERT INTO public.registrations (name, email, event, price) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, array($name, $email, $event, $price));

    if ($result) {
        $message = "<p class='success'>🎉 Registration successful!</p>";
    } else {
        $message = "<p class='error'>❌ Error in registration. Please try again.<br>" . pg_last_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for UPSA Party</title>
    <style>
        /* ... (your previous CSS goes here) ... */
    </style>
</head>
<body>
    <div class="container">
        <h2>UPSA Party Registration Form</h2>
        <?php echo $message; ?>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="event">Event:</label>
            <select name="event" id="event" onchange="updatePrice()" required>
                <option value="">Select Event</option>
                <option value="Gala Night" data-price="100">Gala Night - $100</option>
                <option value="Music Concert" data-price="50">Music Concert - $50</option>
                <option value="After Party" data-price="30">After Party - $30</option>
            </select>

            <label for="price">Price ($):</label>
            <input type="text" name="price" id="price" readonly>

            <input type="submit" value="Register">
        </form>

        <a href="index.html" class="back-link">← Back to Home</a>
    </div>

    <script>
        function updatePrice() {
            const eventSelect = document.getElementById('event');
            const priceInput = document.getElementById('price');
            const selectedOption = eventSelect.options[eventSelect.selectedIndex];
            priceInput.value = selectedOption.getAttribute('data-price') || '';
        }
    </script>
</body>
</html>
