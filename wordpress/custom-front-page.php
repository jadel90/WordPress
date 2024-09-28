<?php
/*
Template Name: Custom Front Page
*/
get_header(); // Include the header

// Display the blog title
echo '<h1>' . get_bloginfo('name') . '</h1>';

// List top-level pages
$top_level_pages = get_pages(array(
    'parent' => 0, // Only top-level pages
    'sort_column' => 'menu_order', // You can change the sorting order
));

if (!empty($top_level_pages)) {
    echo '<ul>';
    foreach ($top_level_pages as $page) {
        echo '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
    }
    echo '</ul>';
}

get_footer(); // Include the footer
?>
