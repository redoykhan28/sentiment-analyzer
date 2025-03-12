<?php
if (!defined('ABSPATH')) {
    exit;
}


//setup admin menu
function sentiment_settings_page() {
    add_options_page('Sentiment Analysis', 'Sentiment Analysis', 'manage_options', 'sentiment-analysis', 'render_sentiment_settings_page');
}

add_action('admin_menu', 'sentiment_settings_page');


// Render the page
function render_sentiment_settings_page() {
    if (isset($_POST['save_sentiment_settings'])) {
        // Check if nonce is set and valid
        if (!isset($_POST['sentiment_nonce']) || !wp_verify_nonce($_POST['sentiment_nonce'], 'save_sentiment_settings')) {
            die('Security check failed');
        }
    
        // Save settings safely
        update_option('positive_keywords', sanitize_text_field($_POST['positive_keywords']));
        update_option('negative_keywords', sanitize_text_field($_POST['negative_keywords']));
        update_option('neutral_keywords', sanitize_text_field($_POST['neutral_keywords']));
        delete_transient('sentiment_filter_cache'); // Clear cache when settings change
    }
    
    ?>

    <!-- setting page form  -->
    <form method="post">

    <!-- added a nonce security token  -->
    <?php wp_nonce_field('save_sentiment_settings', 'sentiment_nonce'); ?>
    
    <label>Add Positive Keywords:</label>
    <input type="text" name="positive_keywords" value="<?php echo esc_attr(get_option('positive_keywords', '')); ?>" style="width: 100%;"><br><br>
    
    <label>Add Negative Keywords:</label>
    <input type="text" name="negative_keywords" value="<?php echo esc_attr(get_option('negative_keywords', '')); ?>" style="width: 100%;"><br><br>
    
    <label>Add Neutral Keywords:</label>
    <input type="text" name="neutral_keywords" value="<?php echo esc_attr(get_option('neutral_keywords', '')); ?>" style="width: 100%;"><br><br>
    
    <input type="submit" name="save_sentiment_settings" value="Save Settings" class="button button-primary">
</form>
    </div>
    <?php
}
