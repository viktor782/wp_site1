<?php
add_theme_support('woocommerce');
add_theme_support('custom-logo');
add_theme_support('menus');
add_theme_support('thumbnail');
add_image_size('cat_item', 230, 210, true);
add_image_size('blog', 305, 245, true);
add_image_size('btand_item', 130, 100, true);
add_image_size('slider2', 670, 530, true);


// правильный способ подключить стили и скрипты
add_action('wp_enqueue_scripts', 'theme_name_scripts');
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function theme_name_scripts()
{
    // styles
    wp_enqueue_style('jcf', get_template_directory_uri() . '/assets/css/jcf.css');
    wp_enqueue_style('the_main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.min.css');
    wp_enqueue_style('owl', get_template_directory_uri() . '/assets/owl/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-default', get_template_directory_uri() . '/assets/owl/assets/owl.theme.default.min.css');

// end styles
    wp_enqueue_script('main_JQ', get_template_directory_uri() . '/assets/js/main-JQ.js', array(), '1.0.0', true);
    wp_enqueue_script('fancybox_js', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.min.js', array(), '1.0.0', true);
    wp_enqueue_script('owl_js', get_template_directory_uri() . '/assets/owl/owl.carousel.min.js', array(), '1.0.0', true);
    wp_enqueue_script('masked', get_template_directory_uri() . '/assets/js/jquery.maskedinput/jquery.maskedinput.min.js', array(), '1.0.0', true);
    wp_enqueue_script('jcf_main', get_template_directory_uri() . '/assets/js/jcf.js', array(), '1.0.0', true);
    wp_enqueue_script('jcf_number', get_template_directory_uri() . '/assets/js/jcf.number.js', array(), '1.0.0', true);
    wp_enqueue_script('main_js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);

}


if (!function_exists('chromium_add_header_scripts')) {
    function chromium_add_header_scripts()
    {
        ?>
        <script>
            var theme_dir = "<?= get_template_directory_uri();  ?>";
            var ajaxurl = "<?= admin_url('admin-ajax.php');  ?>";
            var salePriceNoticeText = "<?php _e('Please enter a value less than the usual price', 'chromium') ?>";
            var price_decimals = "<?php echo wc_get_price_decimals(); ?>";
        </script>
        <?php
    }

    add_action('get_header', 'chromium_add_header_scripts');
    add_action('admin_head', 'chromium_add_header_scripts');
}


include_once "inc/wooc-functions.php";

include_once "inc/new-features.php";
include_once "inc/new-cron.php";
include_once "inc/new-product-fields.php";
include_once "inc/new-scripts.php";

function true_register_wp_sidebars()
{

    /* контакти головна */
    register_sidebar(
        array(
            'id' => 'contact_home', // уникальный id
            'name' => 'Блок контакти - футер Головна', // название сайдбара
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в контент.', // описание
            'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
            'after_title' => '</h3>'
        )
    );
    /* Соціальні футер */
    register_sidebar(
        array(
            'id' => 'contact_min', // уникальный id
            'name' => 'Контакти в на малому футері', // название сайдбара
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в контент.', // описание
            'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
            'after_title' => '</h3>'
        )
    );

    /* Соціальні футер */
    register_sidebar(
        array(
            'id' => 'contact_text', // уникальный id
            'name' => 'Текст в малому футері', // название сайдбара
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в контент.', // описание
            'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
            'after_title' => '</h3>'
        )
    );

    /* Сайдбар в каталозі */
    register_sidebar(
        array(
            'id' => 'shop',
            'name' => 'shop',
            'description' => 'Перетащите сюда виджеты, чтобы добавить их в магазин.',
            'before_widget' => '<div id="%1$s" class="foot widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );

    register_sidebar(
        array(
            'id' => 'header_phones',
            'name' => 'Шапка Телефони',
            'description' => 'Здесь можно поменять телефоны в шапке сайта',
            'before_widget' => '<div id="%1$s" class="foot widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );

}

add_action('widgets_init', 'true_register_wp_sidebars');


function pagination($prev = '«', $next = '»')
{
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged', '%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
    );
    if ($wp_rewrite->using_permalinks())
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

    if (!empty($wp_query->query_vars['s']))
        $pagination['add_args'] = array('s' => get_query_var('s'));

    echo paginate_links($pagination);
}

;


/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs($sep = ' » ', $l10n = array(), $args = array())
{
    $kb = new Kama_Breadcrumbs;
    echo $kb->get_crumbs($sep, $l10n, $args);
}

class Kama_Breadcrumbs
{

    public $arg;

    // Локализация
    static $l10n = array(
        'home' => 'Главная',
        'paged' => 'Страница %d',
        '_404' => 'Ошибка 404',
        'search' => 'Результаты поиска по запросу - <b>%s</b>',
        'author' => 'Архив автора: <b>%s</b>',
        'year' => 'Архив за <b>%d</b> год',
        'month' => 'Архив за: <b>%s</b>',
        'day' => '',
        'attachment' => 'Медиа: %s',
        'tag' => 'Записи по метке: <b>%s</b>',
        'tax_tag' => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
        // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
        // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
    );

    // Параметры по умолчанию
    static $args = array(
        'on_front_page' => true,  // выводить крошки на главной странице
        'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
        'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
        'title_patt' => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
        'last_sep' => true,  // показывать последний разделитель, когда заголовок в конце не отображается
        'markup' => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
        // или можно указать свой массив разметки:
        // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
        'priority_tax' => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
        'priority_terms' => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
        // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
        // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
        // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
        'nofollow' => false, // добавлять rel=nofollow к ссылкам?

        // служебные
        'sep' => '',
        'linkpatt' => '',
        'pg_end' => '',
    );

    function get_crumbs($sep, $l10n, $args)
    {
        global $post, $wp_query, $wp_post_types;

        self::$args['sep'] = $sep;

        // Фильтрует дефолты и сливает
        $loc = (object)array_merge(apply_filters('kama_breadcrumbs_default_loc', self::$l10n), $l10n);
        $arg = (object)array_merge(apply_filters('kama_breadcrumbs_default_args', self::$args), $args);

        $arg->sep = '<span class="kb_sep">' . $arg->sep . '</span>'; // дополним

        // упростим
        $sep = &$arg->sep;
        $this->arg = &$arg;

        // микроразметка ---
        if (1) {
            $mark = &$arg->markup;

            // Разметка по умолчанию
            if (!$mark) $mark = array(
                'wrappatt' => '<div class="kama_breadcrumbs">%s</div>',
                'linkpatt' => '<a href="%s">%s</a>',
                'sep_after' => '',
            );
            // rdf
            elseif ($mark === 'rdf.data-vocabulary.org') $mark = array(
                'wrappatt' => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
                'linkpatt' => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
                'sep_after' => '</span>', // закрываем span после разделителя!
            );
            // schema.org
            elseif ($mark === 'schema.org') $mark = array(
                'wrappatt' => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
                'linkpatt' => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
                'sep_after' => '',
            );

            elseif (!is_array($mark))
                die(__CLASS__ . ': "markup" parameter must be array...');

            $wrappatt = $mark['wrappatt'];
            $arg->linkpatt = $arg->nofollow ? str_replace('<a ', '<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
            $arg->sep .= $mark['sep_after'] . "\n";
        }

        $linkpatt = $arg->linkpatt; // упростим

        $q_obj = get_queried_object();

        // может это архив пустой таксы?
        $ptype = null;
        if (empty($post)) {
            if (isset($q_obj->taxonomy))
                $ptype = &$wp_post_types[get_taxonomy($q_obj->taxonomy)->object_type[0]];
        } else $ptype = &$wp_post_types[$post->post_type];

        // paged
        $arg->pg_end = '';
        if (($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')))
            $arg->pg_end = $sep . sprintf($loc->paged, (int)$paged_num);

        $pg_end = $arg->pg_end; // упростим

        $out = '';

        if (is_front_page()) {
            return $arg->on_front_page ? sprintf($wrappatt, ($paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home)) : '';
        } // страница записей, когда для главной установлена отдельная страница.
        elseif (is_home()) {
            $out = $paged_num ? (sprintf($linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title)) . $pg_end) : esc_html($q_obj->post_title);
        } elseif (is_404()) {
            $out = $loc->_404;
        } elseif (is_search()) {
            $out = sprintf($loc->search, esc_html($GLOBALS['s']));
        } elseif (is_author()) {
            $tit = sprintf($loc->author, esc_html($q_obj->display_name));
            $out = ($paged_num ? sprintf($linkpatt, get_author_posts_url($q_obj->ID, $q_obj->user_nicename) . $pg_end, $tit) : $tit);
        } elseif (is_year() || is_month() || is_day()) {
            $y_url = get_year_link($year = get_the_time('Y'));

            if (is_year()) {
                $tit = sprintf($loc->year, $year);
                $out = ($paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit);
            } // month day
            else {
                $y_link = sprintf($linkpatt, $y_url, $year);
                $m_url = get_month_link($year, get_the_time('m'));

                if (is_month()) {
                    $tit = sprintf($loc->month, get_the_time('F'));
                    $out = $y_link . $sep . ($paged_num ? sprintf($linkpatt, $m_url, $tit) . $pg_end : $tit);
                } elseif (is_day()) {
                    $m_link = sprintf($linkpatt, $m_url, get_the_time('F'));
                    $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
                }
            }
        } // Древовидные записи
        elseif (is_singular() && $ptype->hierarchical) {
            $out = $this->_add_title($this->_page_crumbs($post), $post);
        } // Таксы, плоские записи и вложения
        else {
            $term = $q_obj; // таксономии

            // определяем термин для записей (включая вложения attachments)
            if (is_singular()) {
                // изменим $post, чтобы определить термин родителя вложения
                if (is_attachment() && $post->post_parent) {
                    $save_post = $post; // сохраним
                    $post = get_post($post->post_parent);
                }

                // учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
                $taxonomies = get_object_taxonomies($post->post_type);
                // оставим только древовидные и публичные, мало ли...
                $taxonomies = array_intersect($taxonomies, get_taxonomies(array('hierarchical' => true, 'public' => true)));

                if ($taxonomies) {
                    // сортируем по приоритету
                    if (!empty($arg->priority_tax)) {
                        usort($taxonomies, function ($a, $b) use ($arg) {
                            $a_index = array_search($a, $arg->priority_tax);
                            if ($a_index === false) $a_index = 9999999;

                            $b_index = array_search($b, $arg->priority_tax);
                            if ($b_index === false) $b_index = 9999999;

                            return ($b_index === $a_index) ? 0 : ($b_index < $a_index ? 1 : -1); // меньше индекс - выше
                        });
                    }

                    // пробуем получить термины, в порядке приоритета такс
                    foreach ($taxonomies as $taxname) {
                        if ($terms = get_the_terms($post->ID, $taxname)) {
                            // проверим приоритетные термины для таксы
                            $prior_terms = &$arg->priority_terms[$taxname];
                            if ($prior_terms && count($terms) > 2) {
                                foreach ((array)$prior_terms as $term_id) {
                                    $filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
                                    $_terms = wp_list_filter($terms, array($filter_field => $term_id));

                                    if ($_terms) {
                                        $term = array_shift($_terms);
                                        break;
                                    }
                                }
                            } else
                                $term = array_shift($terms);

                            break;
                        }
                    }
                }

                if (isset($save_post)) $post = $save_post; // вернем обратно (для вложений)
            }

            // вывод

            // все виды записей с терминами или термины
            if ($term && isset($term->term_id)) {
                $term = apply_filters('kama_breadcrumbs_term', $term);

                // attachment
                if (is_attachment()) {
                    if (!$post->post_parent)
                        $out = sprintf($loc->attachment, esc_html($post->post_title));
                    else {
                        if (!$out = apply_filters('attachment_tax_crumbs', '', $term, $this)) {
                            $_crumbs = $this->_tax_crumbs($term, 'self');
                            $parent_tit = sprintf($linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent));
                            $_out = implode($sep, array($_crumbs, $parent_tit));
                            $out = $this->_add_title($_out, $post);
                        }
                    }
                } // single
                elseif (is_single()) {
                    if (!$out = apply_filters('post_tax_crumbs', '', $term, $this)) {
                        $_crumbs = $this->_tax_crumbs($term, 'self');
                        $out = $this->_add_title($_crumbs, $post);
                    }
                } // не древовидная такса (метки)
                elseif (!is_taxonomy_hierarchical($term->taxonomy)) {
                    // метка
                    if (is_tag())
                        $out = $this->_add_title('', $term, sprintf($loc->tag, esc_html($term->name)));
                    // такса
                    elseif (is_tax()) {
                        $post_label = $ptype->labels->name;
                        $tax_label = $GLOBALS['wp_taxonomies'][$term->taxonomy]->labels->name;
                        $out = $this->_add_title('', $term, sprintf($loc->tax_tag, $post_label, $tax_label, esc_html($term->name)));
                    }
                } // древовидная такса (рибрики)
                else {
                    if (!$out = apply_filters('term_tax_crumbs', '', $term, $this)) {
                        $_crumbs = $this->_tax_crumbs($term, 'parent');
                        $out = $this->_add_title($_crumbs, $term, esc_html($term->name));
                    }
                }
            } // влоежния от записи без терминов
            elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $parent_link = sprintf($linkpatt, get_permalink($parent), esc_html($parent->post_title));
                $_out = $parent_link;

                // вложение от записи древовидного типа записи
                if (is_post_type_hierarchical($parent->post_type)) {
                    $parent_crumbs = $this->_page_crumbs($parent);
                    $_out = implode($sep, array($parent_crumbs, $parent_link));
                }

                $out = $this->_add_title($_out, $post);
            } // записи без терминов
            elseif (is_singular()) {
                $out = $this->_add_title('', $post);
            }
        }

        // замена ссылки на архивную страницу для типа записи
        $home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype);

        if ('' === $home_after) {
            // Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
            if ($ptype && $ptype->has_archive && !in_array($ptype->name, array('post', 'page', 'attachment'))
                && (is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)))
            ) {
                $pt_title = $ptype->labels->name;

                // первая страница архива типа записи
                if (is_post_type_archive() && !$paged_num)
                    $home_after = sprintf($this->arg->title_patt, $pt_title);
                // singular, paged post_type_archive, tax
                else {
                    $home_after = sprintf($linkpatt, get_post_type_archive_link($ptype->name), $pt_title);

                    $home_after .= (($paged_num && !is_tax()) ? $pg_end : $sep); // пагинация
                }
            }
        }

        $before_out = sprintf($linkpatt, home_url(), $loc->home) . ($home_after ? $sep . $home_after : ($out ? $sep : ''));

        $out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg);

        $out = sprintf($wrappatt, $before_out . $out);

        return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg);
    }

    function _page_crumbs($post)
    {
        $parent = $post->post_parent;

        $crumbs = array();
        while ($parent) {
            $page = get_post($parent);
            $crumbs[] = sprintf($this->arg->linkpatt, get_permalink($page), esc_html($page->post_title));
            $parent = $page->post_parent;
        }

        return implode($this->arg->sep, array_reverse($crumbs));
    }

    function _tax_crumbs($term, $start_from = 'self')
    {
        $termlinks = array();
        $term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
        while ($term_id) {
            $term = get_term($term_id, $term->taxonomy);
            $termlinks[] = sprintf($this->arg->linkpatt, get_term_link($term), esc_html($term->name));
            $term_id = $term->parent;
        }

        if ($termlinks)
            return implode($this->arg->sep, array_reverse($termlinks)) /*. $this->arg->sep*/
                ;
        return '';
    }

    // добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
    function _add_title($add_to, $obj, $term_title = '')
    {
        $arg = &$this->arg; // упростим...
        $title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
        $show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

        // пагинация
        if ($arg->pg_end) {
            $link = $term_title ? get_term_link($obj) : get_permalink($obj);
            $add_to .= ($add_to ? $arg->sep : '') . sprintf($arg->linkpatt, $link, $title) . $arg->pg_end;
        } // дополняем - ставим sep
        elseif ($add_to) {
            if ($show_title)
                $add_to .= $arg->sep . sprintf($arg->title_patt, $title);
            elseif ($arg->last_sep)
                $add_to .= $arg->sep;
        } // sep будет потом...
        elseif ($show_title)
            $add_to = sprintf($arg->title_patt, $title);

        return $add_to;
    }

}



function ajax_quickorder()
{
    global $woocommerce, $product;
    $address = array(
        'first_name' => $_POST['p_name'],
        'last_name' => $_POST['p_phone'],
    );


    $order = wc_create_order();

    if ($_POST['p_var_id']) {
        $args = array('variation_id' => $_POST['p_var_id'],);
        $order->add_product(wc_get_product($_POST['p_prod_id']), 1, $args);

    } else {
        $order->add_product(wc_get_product($_POST['p_prod_id']), 1);
    }


    $order->set_address($address, 'billing');
    $order->set_address($address, 'shipping');
    $order->calculate_totals();
    $order->update_status("Completed", 'Imported order', TRUE);

    $mail_to = get_option('admin_email');
    $new_order = 'Заказ №' . $order->get_order_number();
    $letter = $new_order . "\r\n" . $_POST['p_name'] . "\r\n" . $_POST['p_phone'];

    mail($mail_to, $new_order, $letter,
        "From: webmaster@barber.sv-mayster.com\r\n"
        . "Reply-To: webmaster@barber.sv-mayster.com\r\n"
        . "X-Mailer: PHP/" . phpversion());
}


function holod_display_catalog_func()
{
    $display_catalog = '';

    if (have_rows('katalogi')):
        $display_catalog .= '<div class="the_catalogs">';
        while (have_rows('katalogi')) : the_row();
            //$display_catalog .= var_dump(get_sub_field('katalog'));
            $arr_katalog = get_sub_field('katalog');
            $display_catalog .= '<a href="' . $arr_katalog["url"] . '" download><img src="' . $arr_katalog["icon"] . '"> ' . $arr_katalog["title"] . '</a>';
        endwhile;
        $display_catalog .= '</div>';
        return $display_catalog;
    else :
        return "Пока нет загруженных каталогов";
    endif;

}

//add_shortcode('holod_display_catalog', 'holod_display_catalog_func');





