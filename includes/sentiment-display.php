<?php
if (!defined('ABSPATH')) {
    exit;
}

function display_badge($content) {

    //display the badge on single post page with sentiment color
    if (is_single()) {
        $sentiment = get_post_meta(get_the_ID(), '_post_sentiment', true);
        $color = ($sentiment == 'positive') ? 'green' : (($sentiment == 'negative') ? 'red' : 'gray');

        $badge = '<span class="sentiment-badge" style="
            background-color: ' . $color . ';
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 30px;">
            Sentiment: ' . ucfirst($sentiment) . '</span><br>';
        return $badge . $content;
    }
    return $content;
}

add_filter('the_content', 'display_badge');
