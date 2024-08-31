<?php
/*
 * This is the child theme for Hello Elementor theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles');
function hello_elementor_child_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

    if (is_product()) {
        wp_enqueue_style("product_pricing_tab", get_theme_file_uri() . "/styles/tabby-ui.min.css");
        wp_enqueue_script("product_pricing_tab", get_theme_file_uri() . "/scripts/tabby.polyfills.min.js");
    }
}

// Change Add to Cart button text on the single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text');
function custom_single_add_to_cart_text()
{
    return __('Buy Now', 'woocommerce');
}

// Redirect to checkout page after add to cart
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');
function custom_add_to_cart_redirect($url)
{
    return wc_get_checkout_url(); // Redirect to checkout page
}

// Clear the cart before adding the new product
add_filter('woocommerce_add_cart_item_data', 'wdm_empty_cart', 10, 3);

function wdm_empty_cart($cart_item_data, $product_id, $variation_id)
{

    global $woocommerce;
    $woocommerce->cart->empty_cart();

    // Do nothing with the data and return
    return $cart_item_data;
}


//pricing table shortcode
add_shortcode("pricing_tabs", function () {
    ob_start();
    ?>
    <ul data-tabs>
        <?php
        global $product;
        $package_terms = $product->get_attributes()['pa_service-type']->get_terms();
        foreach ($package_terms as $index => $package_term) :

            ?>
            <li><a <?php echo $index === 0 ? "data-tabby-default" : ""; ?>
                        href="#<?php echo $package_term -> slug; ?>"><?php echo $package_term->name; ?>></a></li>
        <?php endforeach; ?>
    </ul>

    <?php foreach ($package_terms as $package_term) : ?>
    <div id="<?php echo $package_term -> slug ?>">
        <?php echo $package_term -> description; ?>
    </div>
    <?php endforeach; ?>
    <?php
    return ob_get_clean();
});