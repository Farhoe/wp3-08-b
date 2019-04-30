<?php
require_once("machine.php");
$machine = new machine();
$stats = $machine->getStats();
$submit = filter_input(INPUT_POST, "submit");
if (!empty($submit)) {
    $insertedCoins = filter_input(INPUT_POST, "insertedCoins");
    $productCode = filter_input(INPUT_POST, "productCode");
    $status = $machine->buyProduct($insertedCoins, $productCode);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Šrouby od Matky</title>
</head>

<body>
    <h1>Bagetíčky :)</h1>

    <h3>Automat má <?= $machine->getMachineCoins() ?> penězů.</h3>

    <table id="goods">
        <tr>
            <th>Kod</th>
            <th>Produkt</th>
            <th>Cena</th>
            <th>Počet kusů k dispozici</th>
        <tr>
        <?php
        foreach ($stats['products'] as $key => $product) {
            ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['count'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <form method="POST" action="index.php">
        <label for="insertedCoins">Daj som peňjází-></label>
        <input type="number" id="insertedCoins" name="insertedCoins"><br>
        <?php
        foreach ($stats['products'] as $key => $product) {
            ?>
        <?= $key ?><input type="radio" id="productCode" name="productCode" value="<?= $key ?>"><br>
        <?php
        }
        ?>
        <input type="submit" name="submit" value="Koupit">
    </form>


    <?php
    if (!empty($submit)) {
        ?>
        <span>Status: <?= $status ?></span><br>
        <span>Koupil sis: <?= $machine->getPickupSlot() ?></span><br>
        <span>Automat ti vrátí: <?= $machine->getReturnCoinsSlot() ?></span>
        <?php
    }
    ?>
</body>

</html>