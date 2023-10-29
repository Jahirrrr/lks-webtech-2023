<?php
/**
 * "I absolutely love this product" tab
 * yourtheme/woocommerce/single-product/tabs/love-product.php
 * @author        Mosaika
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
$loves = (get_post_meta($product->id, 'loves', true) != '') ? get_post_meta($product->id, 'loves', true) : 0;
$hates = (get_post_meta($product->id, 'hates', true) != '') ? get_post_meta($product->id, 'hates', true) : 0;
$nonce = wp_create_nonce('love_product'); ?>

<table class="popularity">
	<thead>
		<tr>
			<th><?php _e('Loves', 'msk'); ?></th>
			<th><?php _e('Hates', 'msk'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="loves-number">
				<h3><?php echo $loves; ?></h3>
				<a href="#" class="button alt product-love-hate" data-action="love_product" data-nonce="<?php esc_attr_e($nonce); ?>" data-product-id="<?php esc_attr_e($product->id); ?>">
					<i class="genericon genericon-digg love"></i>
					<span><?php _e('I love this product', 'msk'); ?></span>
				</a>
			</td>
			
			<td class="hates-number">
				<h3><?php echo $hates; ?></h3>
				<a href="#" class="button alt product-love-hate" data-action="hate_product" data-nonce="<?php esc_attr_e($nonce); ?>" data-product-id="<?php esc_attr_e($product->id); ?>">
					<i class="genericon genericon-digg hate"></i>
					<span><?php _e('I hate this product', 'msk'); ?></span>
				</a>
			</td>
		</tr>
	</tbody>
</table>
