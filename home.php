<?php /* Template Name: home */ ?>
<?php get_header('full'); ?>
    <section class="manufacturer">
        <div class="wrapper">
            <div style="display: none">
            <div class="title"><?php _e('Manufacturers', 'holod'); ?></div>
            <div id="manufacurer_nav" class="carousel__nav holder">
                <div class="btn prev"></div>
                <div class="btn next"></div>
            </div>
            </div>
            <div class="manufacturers">
                <div class="holder owl-carousel">
                    <?php
                    $prod_categories = get_terms('pwb-brand', array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => 1, // 1 for yes, 0 for no
                        'parent' => 0 // 1 for show child categories, 0 for show only parent category
                    ));
                    foreach ($prod_categories as $prod_cat) :
                        $cat_thumb_id = get_woocommerce_term_meta($prod_cat->term_id, 'pwb_brand_image', true);
                        $cat_thumb_url = wp_get_attachment_image_src($cat_thumb_id, 'btand_item');
                        $term_link = get_term_link($prod_cat, 'product_cat');
                        ?>
                        <div class="item" id="product_brand<?php echo $prod_cat->term_id; ?>">
                            <a href="<?php echo $term_link; ?>" title="<?php echo $prod_cat->name; ?>"
                               class="button"><img src="<?php echo $cat_thumb_url[0]; ?>" alt=""></a>
                        </div>
                    <?php endforeach;
                    wp_reset_query(); ?>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="main_product_categories" id="main_product_categories">
        <div class="wrapper">
            <div class="holder">
                <?php
                $prod_categories = get_terms('product_cat', array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => 1, // 1 for yes, 0 for no
                    'parent' => 0 // 1 for show child categories, 0 for show only parent category
                ));
                foreach ($prod_categories as $prod_cat) :
                    $cat_thumb_id = get_woocommerce_term_meta($prod_cat->term_id, 'thumbnail_id', true);
                    $cat_thumb_url = wp_get_attachment_image_src($cat_thumb_id, 'cat_item');
                    $term_link = get_term_link($prod_cat, 'product_cat');
                    ?>
                    <div class="item" id="product_category<?php echo $prod_cat->term_id; ?>">
                        <a href="<?php echo $term_link; ?>">
                            <img src="<?php echo $cat_thumb_url[0]; ?>" alt="">
                        </a>
                        <a href="<?php echo $term_link; ?>" title="<?php echo $prod_cat->name; ?>"
                           class="button"><?php esc_html_e('See all', 'holod'); ?><?php echo $prod_cat->name; ?></a>

                        <a href="<?php echo $term_link; ?>" class="name"><?php echo $prod_cat->name; ?></a>
                    </div>
                <?php endforeach;
                wp_reset_query(); ?>
            </div>
            <div class="holder"><a href="<?php echo get_page_link(7); ?>"
                                   class="go_more"><?php _e('View more categories', 'holod'); ?></a></div>
        </div>
    </section>
    <section class="manufacturer bord" id="manuf">
        <div class="wrapper">
            <div class="holder">
                <div class="one_slider">
                    <div class="title"><?php _e('Our manufacture', 'holod'); ?></div>
                    <div class="owl-carousel">
                        <?php wp_reset_query();
                        if (get_field('photo_manufact')): ?>
                            <?php while (the_repeater_field('photo_manufact')): ?>
                                <div>
                                    <img
                                        src="<?php echo wp_get_attachment_image_src(get_sub_field('img'), 'slider1')[0]; ?>"
                                        alt=""/>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div id="one_slider" class="carousel__nav holder">
                        <div class="btn prev"></div>
                        <div class="btn next"></div>
                    </div>
                </div>
                <div class="the_text">
                    <?php wp_reset_query();
                    the_content(); ?>
                    <a href="<?php echo get_permalink(212); ?>"
                       class="go_more"><?php _e('More about production', 'holod'); ?></a>
                </div>
            </div>
        </div>
    </section>
<?php get_footer('full'); ?>