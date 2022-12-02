add_action('woocommerce_cart_calculate_fees', function() {
	if (is_admin() && !defined('DOING_AJAX')) {
		return;
	}
 
	$chosen_payment_method = WC()->session->get('chosen_payment_method');
	$percentage = 0.0725;  // Percentage (5%) in float
	$percentage_fee = (WC()->cart->get_cart_contents_total() + WC()->cart->get_shipping_total()) * $percentage;
	if ($chosen_payment_method == 'other_payment') {
		WC()->cart->add_fee(__('Fee', 'txtdomain'), $percentage_fee);
	}
	if ($chosen_payment_method == 'cheque') {
		WC()->cart->add_fee(__('Fee', 'txtdomain'), $percentage_fee);
	}
});
 
add_action('woocommerce_review_order_before_payment', function() {
    ?><script type="text/javascript">
        (function($){
            $('form.checkout').on('change', 'input[name^="payment_method"]', function() {
                $('body').trigger('update_checkout');
            });
        })(jQuery);
    </script><?php
});
