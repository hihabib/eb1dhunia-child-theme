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
}

// add internal css and js
add_action('wp_head', function (){
    if(is_product()){
        ob_start();
        ?>
        <style>/*! tabbyjs v12.0.3 | (c) 2019 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/tabby */
            [role=tablist]{border-bottom:1px solid #d3d3d3;list-style:none;margin:0;padding:0}[role=tablist] *{box-sizing:border-box}@media (min-width:30em){[role=tablist] li{display:inline-block}}[role=tab]{border:1px solid transparent;border-top-color:#d3d3d3;display:block;padding:.5em 1em;text-decoration:none}@media (min-width:30em){[role=tab]{border-top-color:transparent;border-top-left-radius:.5em;border-top-right-radius:.5em;display:inline-block;margin-bottom:-1px}}[role=tab][aria-selected=true]{background-color:#d3d3d3}@media (min-width:30em){[role=tab][aria-selected=true]{background-color:transparent;border:1px solid #d3d3d3;border-bottom-color:#fff}}[role=tab]:hover:not([aria-selected=true]){background-color:#f7f7f7}@media (min-width:30em){[role=tab]:hover:not([aria-selected=true]){border:1px solid #d3d3d3}}[hidden]{display:none}</style>
        <?php echo ob_get_clean();
    }
});

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