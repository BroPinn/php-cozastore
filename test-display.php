<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Product Display</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Ensure Bootstrap CSS is included -->
</head>
<body>
    <div class="container">
        <div class="row isotope-grid">
            <?php
            // Mock products array with a single product
            $products = [
                [
                    'productID' => 1,
                    'productName' => 'Test Product',
                    'price' => 29.99,
                    'image_path' => 'example.jpg' // Ensure this image exists in the uploads/images/ directory
                ]
            ];
            ?>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?= htmlspecialchars(!empty($product['image_path']) ? 'uploads/images' . $product['image_path'] : 'images/placeholder.jpg') ?>"
                                    alt="<?= htmlspecialchars($product['productName']) ?>" class="img-fluid">

                                <button
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 add-to-cart"
                                    data-product-id="<?= htmlspecialchars($product['productID']) ?>"
                                    data-product-name="<?= htmlspecialchars($product['productName']) ?>"
                                    data-product-price="<?= $product['price'] ?>"
                                    data-product-image="<?= htmlspecialchars($product['image_path']) ?>">
                                    Add To Cart
                                </button>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l">
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
    </div>

</body>
</html>