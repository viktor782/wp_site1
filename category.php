<?php get_header(); ?>
<section class="the__cat holod__blog">
    <div class="wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <h1 class="title"><?php echo get_cat_name($cat); ?></h1>

        <?php if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $params = array(
            'post_type' => array('post'),
            'posts_per_page' => '10',
            'cat' => $cat,
            'paged' => $paged,
        );
        $wp_query->query($params); ?>
        <div class="holder">
            <?php while ($wp_query->have_posts()) :
                $wp_query->the_post(); ?>
                <div class="post-item">
                    <a class="for__img" href="<?php the_permalink(); ?>"><img
                            src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'blog'); ?>"
                            alt="<?php the_title(); ?>">
                    </a>

                    <div class="fot__text">
                        <a href="<?php the_permalink(); ?>" class="post-link">
                            <h2><?php the_title(); ?></h2>
                        </a>
                        <?php the_excerpt(); ?>

                        <a class="go__more" href="<?php the_permalink(); ?>"><?php _e('Go to page', 'holod'); ?></a>

                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="pagination"><?php pagination('«', '»'); ?></div>
    </div>
</section>
<?php get_footer(); ?>

