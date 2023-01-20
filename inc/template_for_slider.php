<div class="owl-carousel">

    <div class="item">
        <img src="<?php echo wp_get_attachment_image_url('slider2'); ?>" alt="">
    </div>
    <?php
    if (have_rows('galereya')):
        while (have_rows('galereya')) : the_row();
            echo '<div class="item">';
            echo var_dump(get_sub_field('img'));
            echo '</div>';
        endwhile;

    else :

    endif;
    ?>


</div>