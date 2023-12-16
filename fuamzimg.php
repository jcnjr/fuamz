<?php
/**
 * Plugin Name: Remove Amazon Images and Links
 * Description: Removes all images hosted by Amazon and any hyperlinks wrapping those images from the website content.
 * Version: 1.3
 * Author: Phineous J Whoopie
 */

function remove_amazon_images_and_wrapping_links($content) {
    // Regex pattern to match <a> tags wrapping <img> tags where the image source contains 'amazon', 
    // or standalone <img> tags with 'amazon' in the source
    $pattern = '/<a [^>]*href=["\'][^"\'<>]+["\'][^>]*>\\s*<img[^>]+src=["\']https?:\/\/[^"\'<>]*amazon[^"\'<>]+["\'][^>]*>\\s*<\/a>|<img[^>]+src=["\']https?:\/\/[^"\'<>]*amazon[^"\'<>]+["\'][^>]*>/is';

    // Replacement pattern to remove the matched tags
    $replacement = '';

    // Perform the replacement
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

// Adding the filter to 'the_content' so it processes post content
add_filter('the_content', 'remove_amazon_images_and_wrapping_links');
