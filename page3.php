<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedToppings = isset($_POST['topping']) ? explode(',', $_POST['topping']) : [];
    $_SESSION['order']['toppings'] = $selectedToppings;
    $_SESSION['order']['totalPrice'] = calculateTotalPrice($selectedToppings);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>SET Pizza Shop - Confirmation</title>
</head>
<body>
    <div class="container">
        <h1>SET Pizza Shop</h1>
        <p>Ciao <?php echo $_SESSION['order']['name']; ?>!</p>
        <p>Your order:</p>
        <ul>
            <?php foreach ($_SESSION['order']['toppings'] as $topping) : ?>
                <li><?php echo ucwords(str_replace(' ', '', $topping)); ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Total Price: $<?php echo number_format($_SESSION['order']['totalPrice'], 2); ?></p>
        <form action="page4.php" method="post">
            <button type="submit" name="confirmation">CONFIRM</button>
            <br>
            <button type="submit" name="cancel">CANCEL</button>
        </form>
    </div>
</body>
</html>

<?php
function calculateTotalPrice($selectedToppings) {
    $basePrice = 10.00;
    $prices = [
        'Pepperoni' => 1.50,
        'Mushrooms' => 1.00,
        'GreenOlives' => 1.50,
        'GreenPeppers' => 1.50,
        'DoubleCheese' => 2.25,
    ];

    $totalPrice = $basePrice;

    foreach ($selectedToppings as $topping) {
        if (isset($prices[$topping])) {
            $totalPrice += $prices[$topping];
        }
    }

    return $totalPrice;
}
?>
