<?php
/*
Plugin Name: Sentiment Analyzer
Description: Analyzes sentiment of post content and displays a sentiment badge.
Version: 1.0
Author: Sezan Ahmed
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('SENTIMENT_ANALYZER_PATH', plugin_dir_path(__FILE__));

// Include necessary files
require_once SENTIMENT_ANALYZER_PATH . 'includes/sentiment-analysis.php';
require_once SENTIMENT_ANALYZER_PATH . 'includes/sentiment-display.php';
require_once SENTIMENT_ANALYZER_PATH . 'includes/sentiment-settings.php';
require_once SENTIMENT_ANALYZER_PATH . 'includes/sentiment-shortcode.php';
