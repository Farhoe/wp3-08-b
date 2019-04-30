<?php


class Machine
{
    private $machineCoins;
    
    private $returnCoinsSlot;
    
    private $pickupSlot;
    
    private $productCount;
    
    public function __construct()
    {
        $this->returnCoinsSlot = null;
        $this->pickupSlot = null;
    }
    
    public function buyProduct($insertedCoins, $productCode)
    {
        if (empty($insertedCoins)) {
            return("Hej tak zaplať ne?");
        }
        if (empty($productCode)) {
            return("Zmáčkni něco...");
        }
        
        $machineCoins = self::getMachineCoins();
        $productName = self::getProductName($productCode);
        $productPrice = self::getProductPrice($productCode);
        $productCount = self::getProductCount($productCode);
        $returnCoins = $insertedCoins - $productPrice;
        if ($insertedCoins >= $productPrice) {
            if ($productCount > 0) {
                if ($machineCoins >= $returnCoins) {
                    $productCount--;
                    $machineCoins -= $returnCoins;
                    $machineCoins += $productPrice;
                    $this->pickupSlot = $productName;
                    $this->returnCoinsSlot = $returnCoins;
                    self::saveChanges($productCode, $productCount, $machineCoins);
                    return true;
                } else {
                    return "Není dost peněz na vrácení";
                }
            } else {
                return "Prázdný automat";
            }
        } else {
            return "Chudej lol. Moc málo peněz";
        }
    }
    
    
    public function getMachineCoins()
    {
        $stats = self::getStats();
        return $stats['machineCoins'];
    }
   
    public function getPickupSlot()
    {
        return $this->pickupSlot;
    }
   
    public function getReturnCoinsSlot()
    {
        return $this->returnCoinsSlot;
    }
    
    private function getProductName($productCode)
    {
        $stats = self::getStats();
        return $stats['products'][$productCode]['name'];
    }
   
    private function getProductPrice($productCode)
    {
        $stats = self::getStats();
        return $stats['products'][$productCode]['price'];
    }
   
    private function getProductCount($productCode)
    {
        $stats = self::getStats();
        return $stats['products'][$productCode]['count'];
    }
   
    public function getStats($file = "stats.json")
    {
        return json_decode(file_get_contents($file), true);
    }
    
    private function saveChanges($productCode, $productCount, $machineCoins)
    {
        $stats = self::getStats();
        $stats['products'][$productCode]['count'] = $productCount;
        $stats['machineCoins'] = $machineCoins;
        file_put_contents("stats.json", json_encode($stats, JSON_PRETTY_PRINT));
        return true;
    }
}
