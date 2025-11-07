<?php
// Include database connection
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event = $_POST['event'];
    $price = $_POST['price'];

    // Insert data into PostgreSQL
    $query = "INSERT INTO registrations (name, email, event, price) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, array($name, $email, $event, $price));

    if ($result) {
        $message = "<p class='success'>🎉 Registration successful!</p>";
    } else {
        $message = "<p class='error'>❌ Error in registration. Please try again.</p>";
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
        /* ===== Base Styles ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* ===== Form Container ===== */
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            color: #fff;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 500;
            color: #fff;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 1em;
        }

        input[readonly] {
            background-color: #eee;
            color: #333;
        }

        /* ===== Button ===== */
        input[type="submit"] {
            width: 100%;
            background: #4b6cb7;
            color: white;
            border: none;
            padding: 12px;
            font-size: 1em;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #182848;
            transform: scale(1.03);
        }

        /* ===== Message Styles ===== */
        .success {
            color: #00ff99;
            background: rgba(0, 255, 153, 0.1);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            color: #ff4444;
            background: rgba(255, 68, 68, 0.1);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        /* ===== Back Button ===== */
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            border: 1px solid #fff;
            padding: 8px 16px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .back-link:hover {
            background-color: #fff;
            color: #182848;
        }

        /* ===== Responsive Design ===== */
        @media (max-width: 480px) {
            .container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>UPSA Party Registration Form</h2>

        <!-- Show message -->
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
