<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    background-image: url("pizza.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: right bottom; 
    margin: 0;
    padding: 0;
}
    </style>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    <title>SET Pizza Shop</title>
</head>
<body>
    <div class="container">
        <h1>SET Pizza Shop</h1>
        <form action="page2.php" method="post">
            <label for="name">Enter your name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Next</button>
        </form>
    </div>
</body>
</html>
