<?php get_header();

$val_holod_single = get_field('podzagolovok_uslugi');
if ($val_holod_single) {
    $holod_single_class = 'servise-single';

} else {
    $holod_single_class = '';
}
?>

<section class="<?php echo($holod_single_class ? $holod_single_class : ''); ?> one__post">
    <div class="wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <h1 class="title"><?php the_title(); ?></h1>
        <?php if ($val_holod_single) {
            echo '<h2>' . $val_holod_single . '</h2>';

        }

        $postcat = get_the_category($post->ID);
        if (!empty($postcat)) {
            $cat_url = $postcat[0]->slug;
        }
        ?>


        <div class="holder">
            <div class="for__slider">
                <div class="owl-carousel">
                    <div class="item">
                        <img src="<?php echo get_the_post_thumbnail_url($post, 'slider2'); ?>" alt="">
                    </div>
                    <?php
                    if (have_rows('galereya')):
                        while (have_rows('galereya')) : the_row();
                            $image = get_sub_field('img');
                            $size = 'slider2';
                            echo '<div class="item"><img src="';
                            echo wp_get_attachment_image_url($image, $size);
                            echo '" alt=""></div>';
                        endwhile;
                    else :
                    endif;
                    ?>


                </div>
                <?php if ($val_holod_single) { ?>
                    <a href="<?php echo home_url() . '/category/' . $cat_url; ?>" class="go__more"><?php _e('Read all posts', 'holod'); ?></a>
                    <div class="clearfix"></div>
                <?php  } ?>
            </div>
            <div class="for__text">
                <?php wp_reset_query();
                the_content();
                if (!$val_holod_single) { ?>
                    <a href="<?php echo home_url() . '/category/' . $cat_url; ?>" class="go__more"><?php _e('Read all posts', 'holod'); ?></a>
              <?php  } ?>
            </div>
        </div>

        <?php
        echo do_shortcode('[wrvp_recently_viewed_products number_of_products_in_row="5" posts_per_page="10"]');
        ?>
    </div>
</section>
<?php get_footer(); ?>

