<?php

class cart
{
    // Function to return List of Products

    public function getProducts()
    {
        $products = [
            ["name" => "Sledgehammer", "price" => 125.75],
            ["name" => "Axe", "price" => 190.50],
            ["name" => "Bandsaw", "price" => 562.131],
            ["name" => "Chisel", "price" => 12.9],
            ["name" => "Hacksaw", "price" => 18.45],
        ];
        return $products;
    }

    // To Add to Product

    public function addToCart()
    {
        $id = intval($_GET["id"]);
        if ($id > 0) {
            if ($_SESSION['cart'] != "") {
                $cart = json_decode($_SESSION['cart'], true);
                $found = false;
                for ($i = 0; $i < count($cart); $i++)
                {
                    if ($cart[$i]["product"] == $id)
                    {
                        $cart[$i]["quantity"] = $cart[$i]["quantity"] + 1;
                        $found = true;
                        break;
                    }
                }
                if (!$found)
                {
                    $line = new stdClass;
                    $line->product = $id;
                    $line->quantity = 1;
                    $cart[] = $line;
                }
                $_SESSION['cart'] = json_encode($cart);
            }
            else
            {
                $line = new stdClass;
                $line->product = $id;
                $line->quantity = 1;
                $cart[] = $line;
                $_SESSION['cart'] = json_encode($cart);
            }
        }
    }

    // Remove from Cart

    public function removeFromCart()
    {
        $id = intval($_GET["id"]);
        if ($id > 0)
        {
            if ($_SESSION['cart'] != "")
            {
                $cart = json_decode($_SESSION['cart'], true);
                for ($i = 0; $i < count($cart); $i++)
                {
                    if ($cart[$i]["product"] == $id)
                    {
                        $cart[$i]["quantity"] = $cart[$i]["quantity"] - 1;
                        if ($cart[$i]["quantity"] < 1)
                        {
                            unset($cart[$i]);
                        }
                        break;
                    }
                }
                $cart = array_values($cart);
                $_SESSION['cart'] = json_encode($cart);
            }
        }
    }

    // Delete Cart

    public function emptyCart()
    {
        $_SESSION['cart'] = "";
    }

    // Retrieve Cart

    public function getCart()
    {
        $cartArray = array();
        if (!empty($_SESSION['cart']))
        {
            $cart = json_decode($_SESSION['cart'], true);
            for ($i = 0; $i < count($cart); $i++)
            {
                $lines = $this->getProductData($cart[$i]["product"]);
                $line = new stdClass;
                $line->id = $cart[$i]["product"];
                $line->price = $lines['price'];
                $line->quantity = $cart[$i]["quantity"];
                $line->product = $lines['name'];
                $line->total = round($lines['price'] * $cart[$i]["quantity"], 2);
                $cartArray[] = $line;
            }
        }
        return $cartArray;
    }

    // Product Data

    private function getProductData($id)
    {
        $products = $this->getProducts();
        return $products[($id - 1)];
    }
}
