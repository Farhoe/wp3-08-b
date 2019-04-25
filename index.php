<?php
require_once('machine.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Šrouby od Matky</title>
</head>
<body>
    <?php
    $coins=100;

    $myMachine = new Machine();
    ?>
    <p>v Automatu je <?php echo $myMachine->getproductsCount(); ?> věcí</p>
    <p><?php echo $myMachine->getmachineCoins(); ?>,-</p>
    <p>Ve výdejním prostoru je: <?php echo $myMachine->getPickupSlot();?></p>
    <p>Slot vrácených peněz: <?php echo $myMachine->getreturnCoinsSlot(); ?>,-</p>
    
    <?php
    $myMachine->buyProduct(100, "2C");
    
    ?>
    <form action="index.php" method="post">
        <input type="radio" value="jedna" name="mlsoun"> Sýrový mlsoun : 45,- <br>
        <input type="radio" value="dva" name="golf"> Golf : 80,- <br> 
        <input type="submit" value="odeslat" name="submit"> 
    
    </form>
 
</body>
</html>