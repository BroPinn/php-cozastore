<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/bootstrap/js/popper.js"></script>
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/moment/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/slick/slick.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/js/slick-custom.js"></script>
	
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/sweetalert/sweetalert.min.js"></script>

	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
	<script>
document.addEventListener('DOMContentLoaded', () => {
    const headerCartItems = document.getElementById('headerCartItems');
    const headerCartTotal = document.getElementById('headerCartTotal');
    const emptyCartMessage = document.getElementById('emptyCartMessage');

    function updateHeaderCart() {
        headerCartItems.innerHTML = '';
        emptyCartMessage.style.display = 'block';
        headerCartTotal.textContent = '$0.00';

        try {
            const savedCart = localStorage.getItem('cartItems');
            if (savedCart) {
                const cartItems = JSON.parse(savedCart);
                if (cartItems.length === 0) {
                    return;
                }
                emptyCartMessage.style.display = 'none';
                let total = 0;
                cartItems.forEach(([key, item]) => {
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
            }
        } catch (error) {
            localStorage.removeItem('cartItems');
        }
    }
    headerCartItems.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-cart-item')) {
            const productId = event.target.getAttribute('data-product-id');
            const savedCart = JSON.parse(localStorage.getItem('cartItems') || '[]');
            const updatedCart = savedCart.filter(([key]) => key !== productId);
            localStorage.setItem('cartItems', JSON.stringify(updatedCart));
            if (window.initCart && window.initCart.removeFromCart) {
                window.initCart.removeFromCart(productId);
            }
            updateHeaderCart();
            window.dispatchEvent(new Event('cartUpdated'));
        }
    });
    window.addEventListener('storage', updateHeaderCart);
    window.addEventListener('cartUpdated', updateHeaderCart);
    updateHeaderCart();
});
</script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/js/main.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

</html>