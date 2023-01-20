<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<?php
 $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $pathFragments = explode('/', $path);
            if($pathFragments[1] == 'brands'){
            ?>

<div class="wrapper back-cat">
 <div class="woocommerce-products-header">
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
<div class="holder">
<div class="for_filter">
                <div class="good_info">
                <div class="title"><?php esc_html_e('Helpful information', 'holod'); ?></div>

<?php   
        $post_wp_query = new WP_Query();
        $params = array(
            'post_type' => array('post'),
            'posts_per_page' => '4',
            'cat' => '42',
        );
        $post_wp_query->query($params); ?>
        <div class="items">
            <?php while ($post_wp_query->have_posts()) : $post_wp_query->the_post(); ?>
                <div class="item">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
                <a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'holod'); ?> > </a>
                </div>
            <?php endwhile; ?>
        </div>

</div>
</div>
<div class="for_products">
 <?php echo do_shortcode('[products brands="'.$pathFragments[2].'"]'); ?>
</div>
</div>
</div>

<?php } else { ?>


    </div>

    <div class="wrapper back-cat">
        <?php
        $cate = get_queried_object();
        $cateID = $cate->term_id;
        $children = get_terms( $cate->taxonomy, array(
            'parent'    => $cate->term_id,
            'hide_empty' => false
        ));
         /*if (count($childs_categories) != 0) { ?>*/
          echo get_the_category_list();

       /*if ($cate->parent == 0)    { */
       if ( $children ) { ?>

            <section class="the_subcats">
                <div class="wrapper">
                 <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action('woocommerce_before_main_content');
        ?>
        <div class="woocommerce-products-header">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
        </div>
                    <div class="holder">
                        <?php
                        $prod_categories = get_terms('product_cat', array(
                            'orderby' => 'parent',
                            'order' => 'ASC',
                            'depth' => 1,
                            'hide_empty' => 1,
                            'parent'    => $cateID,
                            'child_of' => 0, // 1 for show child categories, 0 for show only parent category
                        ));
                        foreach ($prod_categories as $prod_cat) :
                            $cat_thumb_id = get_woocommerce_term_meta($prod_cat->term_id, 'thumbnail_id', true);
                            $cat_thumb_url = wp_get_attachment_image_src($cat_thumb_id, 'cat_item');
                            $term_link = get_term_link($prod_cat, 'product_cat'); ?>

                            <div class="item" id="product_category<?php echo $prod_cat->term_id; ?>">
                                <a href="<?php echo $term_link; ?>" title="<?php echo $prod_cat->name; ?>">
                                    <img src="<?php echo $cat_thumb_url[0]; ?>" alt=""></a>
                                <a href="<?php echo $term_link; ?>" class="name"><?php echo $prod_cat->name; ?></a>
                            </div>
                        <?php  endforeach;
                        wp_reset_query(); ?>
                    </div>
                </div>
            </section>
</div>
        <?php } else { ?>
<div class="holder">
<div class="for_filter">
 <a href="#" class="for_exit">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                     class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 352 512">
                    <path fill="#fff"
                          d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                </svg>
            </a>
<div class="abort_filter">
<div class="title"><span><?php esc_html_e('Filter', 'holod'); ?></span></div>

</div>

 <?php
                if (function_exists('dynamic_sidebar'))
                    dynamic_sidebar('shop');
                ?>

                <div class="good_info">
                <div class="title"><?php esc_html_e('Helpful information', 'holod'); ?></div>

<?php   
        $castom_wp_query = new WP_Query();
        $params = array(
            'post_type' => array('post'),
            'posts_per_page' => '4',
            'cat' => '42',
        );
        $castom_wp_query->query($params); ?>
        <div class="items">
            <?php while ($castom_wp_query->have_posts()) : $castom_wp_query->the_post(); ?>
                <div class="item">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
                <a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'holod'); ?> > </a>
                </div>
            <?php endwhile; ?>
        </div>

</div>
</div>
<div class="for_products">

 <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action('woocommerce_before_main_content');
        ?>
        <div class="woocommerce-products-header">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
        </div>
        <div class="fltr"><?php esc_html_e('Filter', 'holod'); ?></div>
 <?php if (woocommerce_product_loop()) {

                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();

			
                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();
						

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
            }

            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action('woocommerce_after_main_content');

            /**
             * Hook: woocommerce_sidebar.
             *
             * @hooked woocommerce_get_sidebar - 10
             */
            //do_action('woocommerce_sidebar');
            ?>

</div>
</div>
</div>
<section class="cat_desc">
<div class="wrapper">
 <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class=""><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
 <?php  /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
             do_action('woocommerce_archive_description'); ?>
</div>
</section>
 <?php } ?>

<?php }?>
</div>
<?php get_footer('shop');