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

add_action('wp_footer', function (){
    if(is_product()){
        ob_start(); ?>
        <script>/*! tabbyjs v12.0.3 | (c) 2019 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/tabby */
            Element.prototype.matches||(Element.prototype.matches=Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector),Element.prototype.closest||(Element.prototype.matches||(Element.prototype.matches=Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector),Element.prototype.closest=function(e){var t=this;if(!document.documentElement.contains(this))return null;do{if(t.matches(e))return t;t=t.parentElement}while(null!==t);return null}),(function(e,t){"function"==typeof define&&define.amd?define([],(function(){return t(e)})):"object"==typeof exports?module.exports=t(e):e.Tabby=t(e)})("undefined"!=typeof global?global:"undefined"!=typeof window?window:this,(function(e){"use strict";var t={idPrefix:"tabby-toggle_",default:"[data-tabby-default]"},r=function(t){if(t&&"true"!=t.getAttribute("aria-selected")){var r=document.querySelector(t.hash);if(r){var o=(function(e){var t=e.closest('[role="tablist"]');if(!t)return{};var r=t.querySelector('[role="tab"][aria-selected="true"]');if(!r)return{};var o=document.querySelector(r.hash);return r.setAttribute("aria-selected","false"),r.setAttribute("tabindex","-1"),o?(o.setAttribute("hidden","hidden"),{previousTab:r,previousContent:o}):{previousTab:r}})(t);!(function(e,t){e.setAttribute("aria-selected","true"),e.setAttribute("tabindex","0"),t.removeAttribute("hidden"),e.focus()})(t,r),o.tab=t,o.content=r,(function(t,r){var o;"function"==typeof e.CustomEvent?o=new CustomEvent("tabby",{bubbles:!0,cancelable:!0,detail:r}):(o=document.createEvent("CustomEvent")).initCustomEvent("tabby",!0,!0,r),t.dispatchEvent(o)})(t,o)}}},o=function(e,t){var o=(function(e){var t=e.closest('[role="tablist"]'),r=t?t.querySelectorAll('[role="tab"]'):null;if(r)return{tabs:r,index:Array.prototype.indexOf.call(r,e)}})(e);if(o){var n,i=o.tabs.length-1;["ArrowUp","ArrowLeft","Up","Left"].indexOf(t)>-1?n=o.index<1?i:o.index-1:["ArrowDown","ArrowRight","Down","Right"].indexOf(t)>-1?n=o.index===i?0:o.index+1:"Home"===t?n=0:"End"===t&&(n=i),r(o.tabs[n])}};return function(n,i){var a,l,u={};u.destroy=function(){var e=l.querySelectorAll("a");Array.prototype.forEach.call(e,(function(e){var t=document.querySelector(e.hash);t&&(function(e,t,r){e.id.slice(0,r.idPrefix.length)===r.idPrefix&&(e.id=""),e.removeAttribute("role"),e.removeAttribute("aria-controls"),e.removeAttribute("aria-selected"),e.removeAttribute("tabindex"),e.closest("li").removeAttribute("role"),t.removeAttribute("role"),t.removeAttribute("aria-labelledby"),t.removeAttribute("hidden")})(e,t,a)})),l.removeAttribute("role"),document.documentElement.removeEventListener("click",c,!0),l.removeEventListener("keydown",s,!0),a=null,l=null},u.setup=function(){if(l=document.querySelector(n)){var e=l.querySelectorAll("a");l.setAttribute("role","tablist"),Array.prototype.forEach.call(e,(function(e){var t=document.querySelector(e.hash);t&&(function(e,t,r){e.id||(e.id=r.idPrefix+t.id),e.setAttribute("role","tab"),e.setAttribute("aria-controls",t.id),e.closest("li").setAttribute("role","presentation"),t.setAttribute("role","tabpanel"),t.setAttribute("aria-labelledby",e.id),e.matches(r.default)?e.setAttribute("aria-selected","true"):(e.setAttribute("aria-selected","false"),e.setAttribute("tabindex","-1"),t.setAttribute("hidden","hidden"))})(e,t,a)}))}},u.toggle=function(e){var t=e;"string"==typeof e&&(t=document.querySelector(n+' [role="tab"][href*="'+e+'"]')),r(t)};var c=function(e){var t=e.target.closest(n+' [role="tab"]');t&&(e.preventDefault(),r(t))},s=function(e){var t=document.activeElement;t.matches(n+' [role="tab"]')&&(["ArrowUp","ArrowDown","ArrowLeft","ArrowRight","Up","Down","Left","Right","Home","End"].indexOf(e.key)<0||o(t,e.key))};return a=(function(){var e={};return Array.prototype.forEach.call(arguments,(function(t){for(var r in t){if(!t.hasOwnProperty(r))return;e[r]=t[r]}})),e})(t,i||{}),u.setup(),(function(t){if(!(e.location.hash.length<1)){var o=document.querySelector(t+' [role="tab"][href*="'+e.location.hash+'"]');r(o)}})(n),document.documentElement.addEventListener("click",c,!0),l.addEventListener("keydown",s,!0),u}}));</script>
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