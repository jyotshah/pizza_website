<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);

    // Validate name (alphabetic letters, one space allowed)
    if (!preg_match('/^[a-zA-Z]+(?: [a-zA-Z]+)?$/', $name)) {
        header("Location: index.php?error=invalid_name");
        exit();
    }
    $_SESSION['order']['name'] = $name;
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
    <title>SET Pizza Shop</title>
</head>
<body>
    <div class="container">
        <h1>SET Pizza Shop</h1>
        <p>Ciao <?php echo $name; ?>!</p>
        <p>At SET Pizza Shop, you can only order one (1) large pizza with sauce and cheese.</p>
        <form action="page3.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Topping</th>
                        <th>Price</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="images/pepperoni.png" alt="Pepperoni"></td>
                        <td>Pepperoni</td>
                        <td>$1.50</td>
                        <td><input type="checkbox" class="topping" value="Pepperoni" onchange="updateTotalPrice()"></td>
                        
                    </tr>
                    <tr>
                        <td><img src="images/mushroom.jpg" alt="Mushroom"></td>
                        <td>Mushrooms</td>
                        <td>$1.00</td>
                        <td><input type="checkbox" class="topping" value="Mushrooms" onchange="updateTotalPrice()"></td>

                    </tr>
                    <tr>
                        <td><img src="images/greenolive.jpg" alt="GreenOlive"></td>
                        <td>Green Olives</td>
                        <td>$1.50</td>
                        <td><input type="checkbox" class="topping" value="GreenOlives" onchange="updateTotalPrice()"></td>
                    </tr>
                    <tr>
                        <td><img src="images/greenpeppers.jpg" alt="Green Peppers"></td>
                        <td>Green Peppers</td>
                        <td>$1.50</td>
                        <td><input type="checkbox" class="topping" value="GreenPeppers" onchange="updateTotalPrice()"></td>
                    </tr>
                    <tr>
                        <td><img src="images/cheese.png" alt="Cheese"></td>
                        <td>Double Cheese</td>
                        <td>$2.25</td>
                        <td><input type="checkbox" class="topping" value="DoubleCheese" onchange="updateTotalPrice()"></td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="topping" id="hiddenToppings" value="">
            <p>Total Price: $<span id="totalPrice">10.00</span></p>
            <button type="submit" onclick="updateHiddenToppings()">Make It!</button>
        </form>

        <script>
            function updateTotalPrice() {
                var checkboxes = document.getElementsByClassName('topping');
                var totalPrice = 10.00;

                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        switch (checkboxes[i].value) {
                            case 'Pepperoni':
                                totalPrice += 1.50;
                                break;
                            case 'Mushrooms':
                                totalPrice += 1.00;
                                break;
                            case 'GreenOlives':
                                totalPrice += 1.50;
                                break;
                            case 'GreenPeppers':
                                totalPrice += 1.50;
                                break;
                            case 'DoubleCheese':
                                totalPrice += 2.25;
                                break;
                        }
                    }
                }

                document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            }

            function updateHiddenToppings() {
                var checkboxes = document.getElementsByClassName('topping');
                var selectedToppings = [];

                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedToppings.push(checkboxes[i].value);
                    }
                }

                document.getElementById('hiddenToppings').value = selectedToppings.join(',');

                return true;
            }
        </script>
    </div>
</body>
</html>
