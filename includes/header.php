<?php
require_once './service/cart_functions.php';
$cartCount = getCartItemCount();
?>
<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" 
     data-notify="<?= $cartCount ?>">
    <i class="zmdi zmdi-shopping-cart"></i>
</div>
