<?php
/**
 * Plugin Name: Remove Amazon Affiliate Links
 * Description: Automatically removes all full Amazon affiliate links (and amzn.to shortlinks) from posts and product descriptions while preserving the linked text. Must remain activated.
 * Version: 1.5
 * Author: Phineous J Whoopie
 */

// Function to filter the content and remove Amazon links
function remove_amazon_links($content) {
    // Regex pattern to match both http and https full Amazon links
    $pattern = '/<a [^>]*href=["\']http(s)?:\/\/(www\.)?amazon\.[a-z\.]{2,6}\/[^\s"\'<>]+["\'][^>]*>(.*?)<\/a>/is';

    // Replacement pattern to keep only the text
    $replacement = '$3';

    // Perform the replacement
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

// Adding the filter to 'the_content' so it processes post content
add_filter('the_content', 'remove_amazon_links');

// Adding the filter for WooCommerce product descriptions
add_filter('the_excerpt', 'remove_amazon_links');
add_filter('woocommerce_short_description', 'remove_amazon_links');

// Now, the shortened URLs...
// Function to filter the content and remove Amazon shortlinks
function remove_amzn_links($content) {
    // Regex pattern to match Amazon (amzn.to) links, accounting for http and https
    $pattern = '/<a [^>]*href=["\']http(s)?:\/\/amzn\.to\/[a-zA-Z0-9]+["\'][^>]*>(.*?)<\/a>/is';

    // Replacement pattern to keep only the text
    $replacement = '$2';

    // Perform the replacement
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

// Adding the filter to 'the_content' for posts
add_filter('the_content', 'remove_amzn_links');

// Adding the filter for WooCommerce product descriptions
add_filter('the_excerpt', 'remove_amzn_links');
add_filter('woocommerce_short_description', 'remove_amzn_links');
