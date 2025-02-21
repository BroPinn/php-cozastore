<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="headerCartItems">
                <li id="emptyCartMessage" style="display: none;" class="text-center">
                    Your cart is empty
                </li>
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: <span id="headerCartTotal">$0.00</span>
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="index.php?page=checkout" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const headerCartItems = document.getElementById('headerCartItems');
    const headerCartTotal = document.getElementById('headerCartTotal');
    const emptyCartMessage = document.getElementById('emptyCartMessage');

    function updateHeaderCart() {
        //console.log('Updating header cart...'); // Debugging log

        // Clear existing items
        headerCartItems.innerHTML = '';
        
        // Always show empty message initially
        emptyCartMessage.style.display = 'block';
        headerCartTotal.textContent = '$0.00';

        try {
            const savedCart = localStorage.getItem('cartItems');
           // console.log('Saved cart items:', savedCart); // Detailed logging

            if (savedCart) {
                const cartItems = JSON.parse(savedCart);
                //console.log('Parsed cart items:', cartItems); // Detailed logging

                if (cartItems.length === 0) {
                    //console.log('Cart is empty'); // Debugging
                    return;
                }

                // Hide empty message
                emptyCartMessage.style.display = 'none';

                let total = 0;

                cartItems.forEach(([key, item]) => {
                    //console.log('Processing cart item:', item); // Debugging each item

                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    const cartItemElement = document.createElement('li');
                    cartItemElement.className = 'header-cart-item flex-w flex-t m-b-12';
                    cartItemElement.innerHTML = `
                        <div class="header-cart-item-img">
                            <img src="${item.image || './assets/images/placeholder.jpg'}" alt="${item.title}">
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                ${item.title}
                            </a>
                            <span class="header-cart-item-info">
                                ${item.quantity} x $${item.price.toFixed(2)}
                            </span>
                            <button class="btn btn-sm btn-danger remove-cart-item" data-product-id="${key}">
                                Remove
                            </button>
                        </div>
                    `;

                    headerCartItems.appendChild(cartItemElement);
                });

                headerCartTotal.textContent = `$${total.toFixed(2)}`;
                //console.log('Total cart value:', total); // Debugging
            }
        } catch (error) {
           // console.error('Error updating cart:', error);
            // Reset localStorage if there's a parsing error
            localStorage.removeItem('cartItems');
        }
    }

    // Event listener for remove functionality
    headerCartItems.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-cart-item')) {
            const productId = event.target.getAttribute('data-product-id');
            //console.log('Attempting to remove:', productId);

            const savedCart = JSON.parse(localStorage.getItem('cartItems') || '[]');
            const updatedCart = savedCart.filter(([key]) => key !== productId);
            
            localStorage.setItem('cartItems', JSON.stringify(updatedCart));
            
            // Use global cart removal method if available
            if (window.initCart && window.initCart.removeFromCart) {
                window.initCart.removeFromCart(productId);
            }

            updateHeaderCart();
            window.dispatchEvent(new Event('cartUpdated'));
        }
    });

    // Update cart when localStorage changes or custom event is triggered
    window.addEventListener('storage', updateHeaderCart);
    window.addEventListener('cartUpdated', updateHeaderCart);

    // Initial update
    updateHeaderCart();

    // Additional debugging: log localStorage contents
    //console.log('Initial localStorage cartItems:', localStorage.getItem('cartItems'));
});
</script>