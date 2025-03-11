<div class="row isotope-grid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <?php
                        $image_path = ROOT_DIR . '/' . $product['image_path'];
                        $display_path = file_exists($image_path) ? $product['image_path'] : 'https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/placeholder.jpg';
                        ?>
                        <img src="<?= htmlspecialchars($display_path) ?>" 
                            alt="<?= htmlspecialchars($product['productName']) ?>"
                            class="img-fluid">

                        <form method="POST" action="controllers/add_to_cart.php" target="cartFrame">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['productID']) ?>">
                            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['productName']) ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($display_path) ?>">
                            <button type="submit" name="add_to_cart" 
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                Add To Cart
                            </button>
                        </form>
                    </div>
                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                <?= htmlspecialchars($product['productName']) ?>
                            </p>

                            <span class="stext-105 cl3 price">
                                $<?= number_format($product['price'], 2) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products available.</p>
    <?php endif; ?>
</div>