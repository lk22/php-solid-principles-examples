<?php 
// Liskov substitution principle
// Objects in a program should be replaceable with instances of their subtypes without altering the correctness of that program
// Subtypes must be substitutable for their base types

// LSP Liskov Substitution Principle a violation example
class Shipping { 
    public function calculateShippingCost($weightOfPackageKg, $destiny) {
        // pre condition
        if($weightOfPackageKg < 0) {
            throw new Exception("Weight of package must be greater than 0");
        }

        // calculate shipping cost
        $shippingCost = $weightOfPackageKg * 10;

        // post condition
        if($shippingCost < 0) {
            throw new Exception("Shipping cost must be greater than 0");
        }

        return $shippingCost;
    }
}

class WorldWideShipping extends Shipping {
    public function calculateShippingCost($weightOfPackageKg, $destiny) {
        // pre condition
        if($weightOfPackageKg < 0) {
            throw new Exception("Weight of package must be greater than 0");
        }

        // strengthen pre condition ( dont do this )
        // if($weightOfPackageKg < 0.5) {
        //     throw new Exception("Weight of package must be greater than 0.5");
        // }
        // ---------------------------------------------------

        // calculate shipping cost
        $shippingCost = $weightOfPackageKg * 10;

        // by changing post condition ( dont do this )
        // if("USA" === $destiny) {
        //     $shippingCost = $shippingCost * 2;
        // }
        // ------------------------------------------

        // post condition
        if($shippingCost < 0) {
            throw new Exception("Shipping cost must be greater than 0");
        }

        return $shippingCost;
    }
}

// LSP Liskov Substitution Principle a solution example
interface ShippingInterface {
    public function calculateShippingCost($weightOfPackageKg, $destiny);
}

class Shipping implements ShippingInterface {
    public function calculateShippingCost($weightOfPackageKg, $destiny) {
        // pre condition
        if($weightOfPackageKg < 0) {
            throw new Exception("Weight of package must be greater than 0");
        }

        // calculate shipping cost
        $shippingCost = $weightOfPackageKg * 10;

        // post condition
        if($shippingCost < 0) {
            throw new Exception("Shipping cost must be greater than 0");
        }

        return $shippingCost;
    }
}

class WorldWideShipping extends Shipping {
    public function calculateShippingCost($weightOfPackageKg, $destiny) {
        // pre condition
        if($weightOfPackageKg < 0.5) {
            throw new Exception("Weight of package must be greater than 0.5");
        }

        // calculate shipping cost
        $shippingCost = $weightOfPackageKg * 10;

        if("USA" === $destiny) {
            $shippingCost = $shippingCost * 2;
        }

        // post condition
        if($shippingCost < 0) {
            throw new Exception("Shipping cost must be greater than 0");
        }

        return $shippingCost;
    }
}

?>