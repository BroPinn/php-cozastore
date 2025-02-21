window.initCart = (() => {
    const cartItems = new Map();
    const counterDisplay = document.getElementById('shoptxt');

    const updateCartDisplay = () => {
        const totalItems = Array.from(cartItems.values())
            .reduce((sum, item) => sum + (item.quantity || 0), 0) || 0;

        if (counterDisplay) {
            counterDisplay.textContent = totalItems.toString();
            
            const cartIcon = document.querySelector('.icon-header-noti');
            if (cartIcon) {
                cartIcon.setAttribute('data-notify', totalItems.toString());
            }
        }

        // Comprehensive localStorage update
        const cartItemsArray = Array.from(cartItems.entries());
        localStorage.setItem('cartItems', JSON.stringify(cartItemsArray));
        localStorage.setItem('cartTotal', totalItems.toString());

        // Dispatch cart updated event
        window.dispatchEvent(new Event('cartUpdated'));
    };

    const addToCart = (productData) => {
        const { 
            title = 'Unnamed Product', 
            price = 0, 
            description = '', 
            image = './assets/images/placeholder.jpg', 
            productId 
        } = productData;

        //console.log('Adding to cart:', productData);

        // Ensure productId exists and is unique
        const uniqueProductId = productId || `product_${Math.random().toString(36).substr(2, 9)}`;

        // Find existing item with same productId
        const existingItemKey = Array.from(cartItems.keys()).find(key => key === uniqueProductId);

        if (existingItemKey) {
            // Update existing item
            const existingItem = cartItems.get(existingItemKey);
            existingItem.quantity += 1;
            cartItems.set(existingItemKey, existingItem);
        } else {
            // Add new item with complete details
            const newItem = {
                title,
                quantity: 1,
                price,
                description,
                image,
                productId: uniqueProductId
            };

            //console.log('New cart item:', newItem);
            cartItems.set(uniqueProductId, newItem);
        }

        updateCartDisplay();
    };

    const loadCart = () => {
        try {
            const savedCart = localStorage.getItem('cartItems');
            if (savedCart) {
                const parsedCart = JSON.parse(savedCart);
                parsedCart.forEach(([key, value]) => {
                    // Ensure all necessary properties exist
                    const completeItem = {
                        title: value.title || 'Unnamed Product',
                        quantity: value.quantity || 1,
                        price: value.price || 0,
                        description: value.description || '',
                        image: value.image || './assets/images/placeholder.jpg',
                        productId: key
                    };
                    cartItems.set(key, completeItem);
                });
                updateCartDisplay();
            }
        } catch (error) {
            console.error('Error loading cart:', error);
        }
    };

    const removeFromCart = (productId) => {
        if (cartItems.has(productId)) {
            cartItems.delete(productId);
            updateCartDisplay();
        }
    };

    const getCartItems = () => {
        return Array.from(cartItems.entries());
    };

    document.addEventListener('DOMContentLoaded', () => {
        loadCart();

        // Enhanced selector to catch more potential add to cart buttons
        document.querySelectorAll('.add-to-cart, [data-add-to-cart]').forEach(button => {
            button.addEventListener('click', function() {
                // Capture all possible attributes
                const productData = {
                    productId: this.getAttribute('data-product-id') || 
                               this.getAttribute('data-id') || 
                               this.getAttribute('id'),
                    title: this.getAttribute('data-product-name') || 
                           this.getAttribute('data-name') || 
                           this.getAttribute('title'),
                    price: parseFloat(
                        this.getAttribute('data-product-price') || 
                        this.getAttribute('data-price') || 
                        this.getAttribute('price') || 
                        0
                    ),
                    image: this.getAttribute('data-product-image') || 
                           this.getAttribute('data-image') || 
                           this.getAttribute('src') || 
                           './assets/images/placeholder.jpg',
                    description: this.getAttribute('data-product-description') || 
                                 this.getAttribute('data-description') || 
                                 ''
                };

                //console.log('Adding to cart:', productData);

                addToCart(productData);
            });
        });
    });
    
    return {
        addToCart,
        updateCartDisplay,
        loadCart,
        removeFromCart,
        getCartItems
    };
})();