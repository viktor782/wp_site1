<?php get_header(); ?>
    <div class="wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <?php
        wp_reset_query();
        the_content(); ?>
    </div>
<?php get_footer(); ?>