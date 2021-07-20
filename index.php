<?php
    session_start();
    require_once("cart.php");
    $cart = new cart();
    $products = $cart->getProducts();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Shopping Cart</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="main.js"></script>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
        <h1>Products list</h1>
        <table cellpadding="5" cellspacing="0" border="0">
            <tr>
                <td align="left" width="200"><b>Product</b></td>
                <td align="left" width="300" colspan="2"><b>Price</b></td>
            </tr>
            <?php
                foreach ($products as $product_key => $product)
                {
            ?>
                <tr>
                    <td align="left"><?php echo $product['name']; ?></td>
                    <td align="left">$<?php printf("%.2f", $product['price']); ?></td>
                    <td align="center"><span style="cursor:pointer;" class="addToCart" data-id="<?php echo $product_key + 1; ?>">Add to cart</span></td>
                </tr>
            <?php
                }
            ?>
        </table>
        <br/>
        <a href="show-cart.php" title="go to cart">Go to cart</a>
    </body>
</html>