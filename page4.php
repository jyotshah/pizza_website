<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_SESSION['order']['name']) ? $_SESSION['order']['name'] : '';
    $confirmationChoice = isset($_POST['confirmation']) ? 'CONFIRMED' : (isset($_POST['cancel']) ? 'CANCELLED' : '');

    
    $orderDetails = '';
    if ($confirmationChoice === 'CONFIRMED') {
        // Include order details if confirmed
        $orderDetails .= '<p>Your order includes:</p>';
        $selectedToppings = isset($_SESSION['order']['toppings']) ? $_SESSION['order']['toppings'] : [];
        foreach ($selectedToppings as $topping) {
            $orderDetails .= '<p>' . ucwords(str_replace(' ', '', $topping)) . '</p>';
        }

        $totalPrice = isset($_SESSION['order']['totalPrice']) ? $_SESSION['order']['totalPrice'] : 10.00;
        $orderDetails .= '<p>Total Price: $' . number_format($totalPrice, 2) . '</p>';
    }
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
    <title>SET Pizza Shop - Thank You</title>
</head>
<body>
    <div class="container">
        <h1>SET Pizza Shop</h1>
        <p>Thank you, <?php echo $name; ?>!</p>
        <p>Your order has been <?php echo $confirmationChoice; ?>.</p>
        
        <?php echo $orderDetails; ?>
    </div>
</body>
</html>
