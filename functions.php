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
add_action('wp_head', function () {
    if (is_product()) {
        ob_start();
        ?>
        <style>
            /**
             * Vanilla JavaScript Tabs v2.0.1
             * https://zoltantothcom.github.io/vanilla-js-tabs
             */
            .js-tabs{margin:2em;max-width:100%}.js-tabs__header{display:block;margin:0;padding:0;overflow:hidden}.js-tabs__header li{display:inline-block;float:left}.js-tabs__title{background:#f5f5f5;border:1px solid #ccc;cursor:pointer;display:block;margin-right:.5em;padding:1em 1.5em;transition:.25s}.js-tabs__title:hover{text-decoration:none}.js-tabs__title-active{background:#fff;border-bottom-color:#fff;border-top-left-radius:.75em}.js-tabs__content{border:1px solid #ccc;line-height:1.5;margin-top:-1px;padding:1em 2em 3em}</style>
        <?php echo ob_get_clean();
    }
});

add_action('wp_footer', function () {
    if (is_product()) {
        ob_start(); ?>
        <script>
            /**
             * Vanilla JavaScript Tabs v2.0.1
             * https://zoltantothcom.github.io/vanilla-js-tabs
             */
            const Tabs=function(e){var t=document.getElementById(e.elem);if(!t)throw new Error(`Element with ID "${e.elem}" not found`);const n=t;let l=e.open||0;const r="js-tabs__title",c="js-tabs__title-active",o="js-tabs__content",a=n.querySelectorAll("."+r).length;function s(e){n.addEventListener("click",i);var t=d(null==e?l:e);for(let e=0;e<a;e++)n.querySelectorAll("."+r)[e].setAttribute("data-index",e.toString()),e===t&&f(e)}function i(e){var t=e.target.closest("."+r);t&&(e.preventDefault(),f(parseInt(null!=(e=t.getAttribute("data-index"))?e:"0")))}function u(){[].forEach.call(n.querySelectorAll("."+o),e=>{e.style.display="none"}),[].forEach.call(n.querySelectorAll("."+r),e=>{e.className=function(e,t){t=new RegExp(`(\\s|^)${t}(\\s|$)`,"g");return e.replace(t,"")}(e.className,c)})}function d(e){return e<0||isNaN(e)||e>=a?0:e}function f(e){u();e=d(e);n.querySelectorAll("."+r)[e].classList.add(c),n.querySelectorAll("."+o)[e].style.display=""}function y(){n.removeEventListener("click",i)}return s(),{open:f,update:function(e){y(),u(),s(e)},destroy:y}};
            const tabs = Tabs({
                elem: 'tabs',
                open: 0
            });

            /**
             * To Change package by js
             * @param select
             */
            function changeSelect(select){
                Array.from(document.querySelector("#pa_service-type").options).forEach((option, index) => {
                    option.removeAttribute('selected');
                    if(select === index){
                        option.setAttribute('selected', '');
                    }
                })
            }
            changeSelect(1);
            document.querySelectorAll('.js-tabs__title').forEach(
                /**
                 *
                 * @param tab {HTMLElement}
                 */
                tab => {
                tab.addEventListener('click', function(){
                    changeSelect(parseInt(tab.dataset.index) + 1)
                });
            })
        </script>
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
    <div class="js-tabs" id="tabs">
        <ul class="js-tabs__header">
            <?php
            global $product;
            $unsorted_terms = $product->get_attributes()['pa_service-type']->get_terms();
            $sorted_terms = [$unsorted_terms[0], $unsorted_terms[2], $unsorted_terms[1]];
            foreach ($sorted_terms as $package_term) :
                ?>
                <li><a class="js-tabs__title" href="#"><?php echo $package_term->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php foreach ($sorted_terms as $package_term) : ?>
            <div class="js-tabs__content">
                <?php echo $package_term->description; ?>
            </div>
        <?php endforeach;
        unset($unsorted_terms);
        unset($sorted_terms);
        unset($package_term);
        ?>
    </div>

    <?php
    return ob_get_clean();
});