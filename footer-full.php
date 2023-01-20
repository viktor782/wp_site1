<footer class="home" id="footer-home">
    <div class="wrapper">
        <div class="holder device">
            <div class="part50">
                <div class="for__img">
                    <img src="<?php wp_reset_query();
                    the_field('img_footer'); ?>" alt="">
                </div>
            </div>
            <div class="part50">
                <div class="title"><?php esc_html_e('Looking for equipment?', 'holod'); ?></div>
                <p><?php esc_html_e('Our specialists will help you choose:', 'holod'); ?></p>
                <div class="min_contacts">
                    <?php
                    if (function_exists('dynamic_sidebar'))
                        dynamic_sidebar('contact_home'); 
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="two_lines"></div>
    <div class="wrapper">
        <div class="holder cont">
            <div class="foot_contacts">
                <?php
                if (function_exists('dynamic_sidebar'))
                    dynamic_sidebar('contact_min');
                ?>
            </div>
            <div class="foot_credo">
                <?php
                if (function_exists('dynamic_sidebar'))
                    dynamic_sidebar('contact_text');
                ?>
            </div>
            <div class="foot_contacts">
                <p class="align-center"><strong><?php esc_html_e('Order a consultation', 'holod'); ?></strong></p>
                <?php
                if(get_locale() == 'ru_RU'){
                    $lang_cod = '[contact-form-7 id="5" title="consult"]';
                } else {
                    $lang_cod = '[contact-form-7 id="222" title="consult_ua"]';
                }
                echo do_shortcode($lang_cod); ?>
                <a class="foot_video" data-fancybox href="<?php the_field('video_man', 61); ?>"><?php _e('Watch a video about the production of our equipment', 'holod'); ?> <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/img/play.png" alt=""></a>
            </div>
        </div>
        <div class="holder">
            <div class="copy">&copy; <?php _e('Copyright', 'holod'); ?></div>
            <div class="madeby"><?php _e('Developers', 'holod'); ?> <a href="https://www.websitekm.com/" target="_blank"><?php _e('Internet studio
                     WS advertising', 'holod'); ?></a></div>
        </div>
    </div>
</footer>
<div class="popup_1">
    <div class="exit"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="#fff" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></div>
    <p class="align-center"><strong><?php _e('Order a consultation', 'holod'); ?></strong></p>
    <?php
    if(get_locale() == 'ru_RU'){
        $lang_cod = '[contact-form-7 id="5" title="consult"]';
    } else {
        $lang_cod = '[contact-form-7 id="222" title="consult_ua"]';
    }
    echo do_shortcode($lang_cod); ?>
    <div class="bob"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="00ffff" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z"></path></svg></div>
</div>
<?php wp_footer(); ?>
</body>
</html