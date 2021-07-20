<?php
    session_start();
    require_once("cart.php");
    $cart = new cart();
    $products = $cart->getCart();
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
        <h1>Show cart</h1>
        <table cellpadding="5" cellspacing="0" border="0">
            <tr>
                <td align="left" width="200"><b>Product</b></td>
                <td align="left" width="200"><b>Price</b></td>
                <td align="left" width="200"><b>Quantity</b></td>
                <td align="left" width="200" colspan="2"><b>Total</b></td>
            </tr>
            <?php
                $overall_total = 0;
                foreach ($products as $product)
                {
            ?>
            <tr>
                <td align="left"><?php echo $product->product; ?></td>
                <td align="left">$<?php printf("%.2f", $product->price); ; ?></td>
                <td align="left"><?php echo $product->quantity; ?></td>
                <td align="left">$<?php printf("%.2f", $product->total); ?></td>
                <td align="center"><span style="cursor:pointer;" class="removeFromCart" data-id="<?php echo $product->id; ?>">Remove one element</span></td>
            </tr>
            <?php
                    $overall_total += $product->total;
                }
            ?>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="left">Overall Total</td>
                <td></td>
                <td></td>
                <td align="left">$<?php printf("%.2f", $overall_total); ?></td>
            </tr>
        </table>
        <br/>
        <a href="index.php" title="go back to products">Go back to products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="emptyCart" title="empty cart">Empty cart</a>
    </body>
</html>