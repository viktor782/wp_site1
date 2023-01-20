<?php /* Template Name: contacts */ ?>
<?php get_header(); ?>

<section class="text-page servise-single">
    <div class="wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="holder">
            <div class="for__text">
                <?php wp_reset_query();
                the_content(); ?>
            </div>
        </div>
        <div class="for__form">
<div class="cc__form">
    <div class="title"><?php _e('Want to consult a specialist?', 'holod'); ?></div>
    <?php
    if(get_locale() == 'ru_RU'){
        $lang_cod = '[contact-form-7 id="203" title="cc_form"]';
    } else {
        $lang_cod = '[contact-form-7 id="221" title="cc_form_ua"]';
    }
    echo do_shortcode($lang_cod); ?>
</div>
        </div>
    </div>
    <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83014.3193089461!2d26.988573899999988!3d49.44298450000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4732064344bb178b%3A0xd9f30b3b24d9c964!2z0KXQvNC10LvRjNC90LjRhtC60LjQuSwg0KXQvNC10LvRjNC90LjRhtC60LDRjyDQvtCx0LvQsNGB0YLRjCwgMjkwMDA!5e0!3m2!1sru!2sua!4v1570808029842!5m2!1sru!2sua" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>

</section>
<?php get_footer(); ?>
