<?php

class Machine
{
    private $machineCoins;
    private $pickupSlot;
    private $returnCoinsSlot;


    private $products;



    public function __construct()
    {
        $this->machineCoins = file_get_contents("productsCoins.txt");
        $this->products = array(
            "1A" => array("name" => "golf", "price" => 45, "count" => file_get_contents('1A.txt')),
            "2C" => array("name" => "sýrový mlsoun", "price" => 80, "count" => file_get_contents('2C.txt')),
        );
        $this->pickupSlot = null;
    }
    public function buyProduct($insertedCoins, $productNumber = "1A")
    {
        var_dump($insertedCoins);
        var_dump($this->products[$productNumber]['price']);
        $returnCoins = $insertedCoins - $this->products[$productNumber]['price'];
        if (($insertedCoins>= $this->products[$productNumber]['price'])
        && ($this->productsCount > 0)
        && ($this->machineCoins>=$returnCoins)) {
            $this->machineCoins-= $returnCoins;
            file_put_contents("productsCoins.txt", $this->machineCoins);
            $this->productsCount--;
            file_put_contents("productsCount.txt", $this->productsCount);
            $this->pickupSlot = $this->products[$productNumber]['name'];
            $this->returnCoinsSlot = $returnCoins;
            return true;
        }
        return false;
    }
    public function getPickupSlot()
    {
        if (empty($this->pickupSlot)) {
            $this->pickupSlot = "Nic tu není... :(";
        }
        return $this->pickupSlot;
    }
    public function getProductsCount()
    {
        $productsCount = 0;

        foreach ($this->products as $product) {
            $productsCount += $product['count'];
        }
    }
    public function getMachineCoins()
    {
        return $this->machineCoins;
    }
    public function getReturnCoinsSlot()
    {
        return $this->returnCoinsSlot;
    }
}
