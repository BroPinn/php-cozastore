<?php 
require_once './service/cart_functions.php';
$cartItems = getCartItems();
$cartTotal = getCartTotal();
?>
<iframe name="cartFrame" style="display:none;"></iframe>
<div class="wrap-header-cart">
    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">Your Cart</span>
            <a href="index.php" class="fs-35 lh-10 cl2 p-lr-5">×</a>
        </div>

        <div class="header-cart-content flex-w">
            <ul class="header-cart-wrapitem w-full">
                <?php if (empty($cartItems)): ?>
                    <li class="text-center">Your cart is empty</li>
                <?php else: ?>
                    <?php foreach ($cartItems as $productID => $item): ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <form method="POST" action="controllers/update_cart.php" target="cartFrame">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($productID) ?>">
                                    <button type="submit" name="remove_item" class="how-itemcart1">
                                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="IMG">
                                    </button>
                                </form>
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <span class="header-cart-item-name m-b-18">
                                    <?= htmlspecialchars($item['name']) ?>
                                </span>
                                <div class="header-cart-item-info">
                                    <form method="POST" action="controllers/update_cart.php" target="cartFrame" 
                                          class="wrap-num-product flex-w m-l-auto m-r-0" style="display:inline-block">
                                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($productID) ?>">
                                        <button type="submit" name="decrease" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">-</button>
                                        <input class="mtext-104 cl3 txt-center num-product" type="number" 
                                               name="num-product" value="<?= $item['quantity'] ?>" readonly>
                                        <button type="submit" name="increase" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">+</button>
                                    </form>
                                    <span class="header-cart-item-price">
                                        $<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40"></div>
                    Total: $<?= number_format($cartTotal, 2) ?>
                </div>

                <div class="header-cart-buttons flex-w w-full"></div>
                    <a href="index.php?page=cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10"></a>
                        View Cart
                    </a>
                    <a href="index.php?page=checkout" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

