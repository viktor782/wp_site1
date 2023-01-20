<?php /* Template Name: brands-page */ ?>
<?php get_header(); ?>

    <section class="text-page">
        <div class="wrapper">
            <?php woocommerce_breadcrumb(); ?>
            <h1 class="title"><?php the_title(); ?></h1>
            <div>
                <?php wp_reset_query(); the_content(); ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>