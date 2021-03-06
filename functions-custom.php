<?php

	show_admin_bar(false);

	function custom_get_excerpt($id, $limit) {
		$excerpt = explode(' ', get_the_excerpt($id), $limit);

		if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt) . '...';
		} else {
				$excerpt = implode(" ", $excerpt);
		}

		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

		return $excerpt;
	}

	function custom_next_post($post_id){
		$next_post = get_adjacent_post( true, '', true );
		if (is_a($next_post, 'WP_Post')){
			$category = get_the_category( $next_post->ID );

			$echo = "<a href=" . get_permalink($next_post->ID) . " class='single-pagination__link single-pagination__link_next'>";
				$echo .= "<span class='single-pagination__link-category'>".esc_html( $category[0]->name )."</span>";
				$echo .= "<span class='single-pagination__link-name'>".get_the_title($next_post->ID)."</span>";
			$echo .= "</a>";
			echo $echo;
		}
	}

	function custom_prev_post($post_id){
		$prev_post = get_adjacent_post( true, '', false );

		if (is_a($prev_post, 'WP_Post')){
			$category = get_the_category( $prev_post->ID );

			$echo = "<a href=" . get_permalink($prev_post->ID) . " class='single-pagination__link single-pagination__link_prev'>";
				$echo .= "<span class='single-pagination__link-category'>".esc_html( $category[0]->name )."</span>";
				$echo .= "<span class='single-pagination__link-name'>".get_the_title($prev_post->ID)."</span>";
			$echo .= "</a>";
			echo $echo;
		}
	}

	function cmb2_sanitize_text_callback( $override_value, $value ) {
		//convert square brackets to angle brackets
		$value = str_replace('[', '<', $value);
		$value = str_replace(']', '>', $value);
		return $value;
	}
	add_filter( 'cmb2_sanitize_text', 'cmb2_sanitize_text_callback', 10, 2 );


	/**
	 * Show cart contents / total Ajax
	 */
	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
		<a class="cart-items" href="<?php echo wc_get_cart_url(); ?>">
			<span class="cart-items__icon"></span>
			<span class="cart-items__number"><?php echo WC()->cart->get_cart_contents_count() ?></span>
		</a>
		<?php
		$fragments['a.cart-items'] = ob_get_clean();
		return $fragments;
	}

	function custom_woocommerce_cart(){
	?>
		<a class="cart-items" href="<?php echo wc_get_cart_url(); ?>">
			<span class="cart-items__icon"></span>
			<span class="cart-items__number"><?php echo WC()->cart->get_cart_contents_count() ?></span>
		</a>
<?php  
	}

	/**
	 * Change currency display in WooCommerce
	 * Put this in your functions.php file
	 *
	 */

	add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

	function change_existing_currency_symbol( $currency_symbol, $currency ) {
		 switch( $currency ) {
				case 'UAH': $currency_symbol = 'грн '; break;
		 }
		 return $currency_symbol;
	}


	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 2; // 2 products per row
		}
	}


	/**
	 * Change number of related products output
	 */
	add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
		return $args;
	}

	/**
	 * Change number of upsells output
	 */
	add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products' );

	function wc_change_number_related_products( $args ) {
	 
	 $args['posts_per_page'] = 3;
	 $args['columns'] = 3; //change number of upsells here
	 return $args;
	}


?>