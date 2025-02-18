<?php
require_once 'database.php';

try {
    $pdo = connectToDatabase();
    $statement = $pdo->prepare('SELECT * FROM tbl_slider WHERE slider_status = 1 ORDER BY slider_id');
    $statement->execute();
    $sliders = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $sliders = []; // Fallback to empty array
    error_log("Slider fetch error: " . $e->getMessage());
}
?>

<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php foreach($sliders as $slider): ?>
            <div class="item-slick1" style="background-image: url(<?= htmlspecialchars($slider['slider_image']) ?>);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                <?= htmlspecialchars($slider['slider_subtitle']) ?>
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                <?= htmlspecialchars($slider['slider_title']) ?>
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="index.php?page=<?= htmlspecialchars($slider['slider_link']) ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>