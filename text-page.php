<?php /* Template Name: text-page */ ?>
<?php get_header(); ?>

<section class="text-page servise-single">
    <div class="wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <h1 class="title"><?php the_title(); ?></h1>
        <h2> <?php the_field('pidzagolovok'); ?></h2>
        <div class="holder">
            <div class="for__text">
                <?php wp_reset_query();
                the_content(); ?>
            </div>
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
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
