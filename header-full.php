<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <title>
        <?php wp_title('|', true, 'right'); ?>
    </title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="overflow"></div>
<div class="popup_flow"></div>
<header class="in_home">
    <ul id="top-menu">
        <li><span class="up"></span></li>
        <li class="active" data-num="0">
            <a href="#"></a>
        </li>
        <li data-num="1">
            <a  href="#main_product_categories"></a>
        </li>
        <li data-num="2">
            <a href="#manuf"></a>
        </li>
        <li data-num="3">
            <a href="#footer-home"></a>
        </li>
        <li><span class="down"></span></li>
    </ul>
    <div class="wrapper">
        <div class="holder">
            <?php the_custom_logo();
            wp_nav_menu([
                'menu' => 'main',
                'container' => 'div',
                'container_class' => 'navbar-collapse collapse',
                'container_id' => '',
                'menu_class' => 'nav navbar-nav navbar-right',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
                'walker' => '',
            ]);
            ?>
            <div class="menu-toggle">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg>
            </div>
            <div class="menu_mother">

            </div>
            <div class="lang">
                <?php qtranxf_generateLanguageSelectCode('text', 'language'); ?>
            </div>
            <div class="the__search">
                <?php echo do_shortcode('[yith_woocommerce_ajax_search]'); ?>
            </div>

            <div class="cont__cart">
                <div class="phones">
                    <?php
                    if (function_exists('dynamic_sidebar'))
                        dynamic_sidebar('header_phones');
                    ?>
                </div>
                <a class="call_me to_pop" href="#"><?php _e('Call me', 'holod'); ?></a>

                <div id="site-header-cart">
                    <?php custom_mini_cart(); ?>
                </div>
            </div>
        </div>
        <div class="holder free_margin">
            <div class="credo">
                <?php the_field('credo'); ?>
            </div>
            <div class="with_video">
                <div class="video_head_bg"></div>

                <a data-fancybox href="<?php the_field('video_man', 61); ?>" class="video_man">
                    <div class="circlephone" style="transform-origin: center;"></div>
                    <div class="circle-fill" style="transform-origin: center;"></div>
                    <div class="img-circle" style="transform-origin: center;">
                        <div class="img-circleblock" style="transform-origin: center;"></div>
                    </div>
                    <p><?php _e('Watch a video about the production of our equipment', 'holod'); ?></p>
                </a>
            </div>
        </div>
        <div class="holder">
            <div class="buttons">
                <a href="#" class="btn_1 to_pop"><?php _e('Consultation', 'holod'); ?></a>
                <a href="<?php the_permalink(7); ?>" class="btn_2"><?php _e('Equipment', 'holod'); ?></a>
            </div>
            <div class="other__menu">
            <?php
            wp_nav_menu([
                'menu' => 'second_menu',
                'container' => 'div',
                'container_class' => 'navbar-collapse collapse',
                'container_id' => '',
                'menu_class' => 'nav navbar-nav navbar-right',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
                'walker' => '',
            ]);
            ?>
            </div>
        </div>
        <a href="#" class="go__cat__menu"><?php _e( 'Product Catalog', 'woocommerce' ); ?></a>
        <div class="mob__cat__menu">
            <a href="#" class="for_exit"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="#fff" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></a>
            <div class="title"><?php _e( 'Product Catalog', 'woocommerce' ); ?></div>
            <?php
            wp_nav_menu([
                'menu' => 'mob_cat_menu',
                'container' => 'div',
                'container_class' => 'navbar-collapse collapse',
                'container_id' => '',
                'menu_class' => 'nav navbar-nav navbar-right',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
                'walker' => '',
            ]);
            ?>
        </div>
    </div>
</header>
