<?php
if (!defined('ABSPATH')) {
    exit;
}

// count and store the sentiment during save post
function analyze_post_sentiment($post_id) {

    // Prevent auto-saves and invalid post types
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    // Ensure it's a valid post type (modify if needed)
    $post_type = get_post_type($post_id);
    if ($post_type !== 'post') { 
        return;
    }

    // Get post content
    $content = get_post_field('post_content', $post_id);

    // Define sentiment labels
    $positive_words = array_map('trim', explode(',', get_option('positive_keywords', '')));
    $negative_words = array_map('trim', explode(',', get_option('negative_keywords', '')));
    $neutral_words  = array_map('trim', explode(',', get_option('neutral_keywords', '')));

    // Initialize counters
    $positive_count = 0;
    $negative_count = 0;
    $neutral_count  = 0;

    // Convert content to lowercase for better matching
    $content_lower = strtolower($content);

    // Count occurrences for positive keywords
    foreach ($positive_words as $word) {
        $positive_count += substr_count($content_lower, $word);
    }

    // Count occurrences for negative keywords
    foreach ($negative_words as $word) {
        $negative_count += substr_count($content_lower, $word);
    }

    // Count occurrences for neutral keywords
    foreach ($neutral_words as $word) {
        $neutral_count += substr_count($content_lower, $word);
    }

    // Determine sentiment
    if ($positive_count > $negative_count && $positive_count > $neutral_count) {
        $sentiment = 'positive';
    } elseif ($negative_count > $positive_count && $negative_count > $neutral_count) {
        $sentiment = 'negative';
    } else {
        $sentiment = 'neutral';
    }

    // Store sentiment in post meta
    update_post_meta($post_id, '_post_sentiment', $sentiment);
}

add_action('save_post', 'analyze_post_sentiment');
