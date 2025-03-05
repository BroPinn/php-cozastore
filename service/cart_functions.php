<?php

function addToCart($productID, $productName, $price, $image, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productID] = [
            'name' => $productName,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
}

function getCartItems() {
    return $_SESSION['cart'] ?? [];
}

function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

function getCartItemCount() {
    if (!isset($_SESSION['cart'])) {
        return 0;
    }
    return array_sum(array_column($_SESSION['cart'], 'quantity'));
}

function updateCartQuantity($productID, $action) {
    if (!isset($_SESSION['cart'][$productID])) {
        return false;
    }

    if ($action === 'increase') {
        $_SESSION['cart'][$productID]['quantity']++;
    } elseif ($action === 'decrease') {
        if ($_SESSION['cart'][$productID]['quantity'] > 1) {
            $_SESSION['cart'][$productID]['quantity']--;
        } else {
            removeFromCart($productID);
        }
    }
    return true;
}

function removeFromCart($productID) {
    if (isset($_SESSION['cart'][$productID])) {
        unset($_SESSION['cart'][$productID]);
    }
}
