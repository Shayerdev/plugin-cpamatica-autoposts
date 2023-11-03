<?php

namespace CAP\shortcode;

use CAP\CpamaticaAutoPosts;
use CAP\helpers\CreateShortcode;

class PostsList extends CreateShortcode
{
    /**
     * Tag shortcode
     *
     * @var string
     */
    public $name;

    public function __construct()
    {
        $this->name = "posts_list_shortcode";
        parent::__construct(array($this, 'callback'));
    }
    public function callback()
    {
        add_shortcode($this->name, function ($attr) {
            $attr = shortcode_atts(array(
                'title' => 'Articles',
                'count' => 5,
                'sort' => 'date',
                'ids' => []
            ), $attr, $this->name);

                do_action('init_postlist_shortcode');

                $args = array(
                    'post_type' => CpamaticaAutoPosts::getInstance()->settings['post_type'],
                    'post_status' => 'publish',
                    'posts_per_page' => is_string($attr['count']) ? intval($attr['count']) : $attr['count'],
                    'orderby' => $attr['sort'],
                );

                // Filter by ids
            if (!empty($attr['ids'])) {
                $args['post__in'] = array_map('intval', explode(',', $attr['ids']));
            }

                // FIlter by title
            if ($attr['sort'] === 'title') {
                $args['orderby'] = 'title';
            }

                // Filter by rating
            if ($attr['sort'] === 'rating') {
                $args['meta_key'] = 'meta_my_rating_field'; // Замените на имя вашего метаполя
                $args['orderby'] = 'meta_value_num';
            }

                $posts = new \WP_Query($args);
                $content  = '';

            if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                    $posts->the_post();
                    $img = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                    $title = get_the_title();
                    $link = get_the_permalink();
                    $rating = get_post_meta(get_the_ID(), CpamaticaAutoPosts::getInstance()->settings['slug_meta'] . 'rating', true);
                    $nf_link = get_post_meta(get_the_ID(), CpamaticaAutoPosts::getInstance()->settings['slug_meta'] . 'link', true);
                    $category = wp_get_post_categories(get_the_ID())[0];

                    $category_row = sprintf("<div class='row-category'>%s</div>", get_category($category)->name);
                    $title_row = sprintf("<a href='%s'><h4>%s</h4></a>", $link, $title);
                    $rating_row = (!empty($rating)) ? sprintf("<span class='rating'>⭐️ %s</span>", $rating) : '';
                    $nf_link_row = (!empty($nf_link)) ? sprintf("<a rel='nofollow' target='_blank' href='%s'>%s</a>", $nf_link, __('Visit site', 'cpamatica-auto-post')) : '';
                        $bottom_row = sprintf("
                            <div class='row-bottom'>
                                <a href='%s'>%s</a>
                                <div class='left-col'>%s %s</div>
                            </div>
                         ", $link, __('Read More', 'cpamatica-auto-post'), $rating_row, $nf_link_row);

                    $article = sprintf("
                            <article class='post-%s'>
                                <div class='image-banner'>%s</div>
                                <div class='content'>%s %s %s</div>
                            </article>", get_the_ID(), $img, $category_row, $title_row, $bottom_row);
                    $content .= $article;
                }
            } else {
                $content = sprintf("<p>%s</p>", __('Articles empty', 'cpamatica-auto-post'));
            }

                $section = sprintf(
                    "<section class='%s'><div class='container'><h2>%s</h2>%s</div></section>",
                    'cpmaticaautopost',
                    !empty($attr['title']) ? $attr['title'] : __('Articles', 'cpamatica-auto-post'),
                    $content
                );
                return $section;
        });
    }
}
