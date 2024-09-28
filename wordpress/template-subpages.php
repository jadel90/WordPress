<?php
// Define the parent page ID (level 1 page)
$parent_page_id = 1922;

// Get subpages of the level 1 page (direct children)
$subpages = get_pages(array(
    'child_of'    => $parent_page_id,
    'parent'      => $parent_page_id,
    'sort_column' => 'menu_order'
));

if (!empty($subpages)) {
    echo '<ul class="subpage-list">';
    foreach ($subpages as $subpage) {
        // Display subpages of level 1
        echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a>';

        // Check if there are sub-subpages (level 2)
        $subsubpages = get_pages(array(
            'child_of'    => $subpage->ID,
            'parent'      => $subpage->ID,
            'sort_column' => 'menu_order'
        ));

        if (!empty($subsubpages)) {
            echo '<ul class="subsubpage-list">';
            foreach ($subsubpages as $subsubpage) {
                // Display sub-subpages of level 2
                echo '<li><a href="' . get_permalink($subsubpage->ID) . '">' . $subsubpage->post_title . '</a></li>';
            }
            echo '</ul>'; // Close the sub-subpage list
        }

        echo '</li>'; // Close the subpage list item
    }
    echo '</ul>'; // Close the subpage list
}
?>
