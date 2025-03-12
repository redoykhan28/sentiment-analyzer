<?php
if (!defined('ABSPATH')) {
    exit;
}

function sentiment_filter_shortcode($atts) {
    $atts = shortcode_atts([
        'sentiment' => 'positive',
        'posts_per_page' => 5
    ], $atts, 'sentiment_filter');
    
    $cache_key = 'sentiment_filter_' . md5(json_encode($atts));
    $cached_result = get_transient($cache_key);
    if ($cached_result) return $cached_result;
    
    $query = new WP_Query([
        'post_type' => 'post',
        'meta_key' => '_post_sentiment',
        'meta_value' => $atts['sentiment'],
        'posts_per_page' => intval($atts['posts_per_page'])
    ]);
    
    ob_start();
    
    //if post exist it will display
    if ($query->have_posts()) {
        echo '<ul class="sentiment-posts">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No posts found: ' . esc_html($atts['sentiment']) . '</p>';
    }
    wp_reset_postdata();
    
    $output = ob_get_clean();
    set_transient($cache_key, $output, HOUR_IN_SECONDS);
    return $output;
}

add_shortcode('sentiment_filter', 'sentiment_filter_shortcode');
