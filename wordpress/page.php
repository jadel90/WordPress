<?php
// Start the loop.
while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="entry-header">
            <!-- Your title here -->
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <!-- Your content here -->
            <?php the_content(); ?>
        </div><!-- .entry-content -->
        
    </article><!-- #post-## -->

    <?php echo get_search_form(); ?>


    <?php
$page_id = 1898; // Replace with the specific page ID

if (is_page($page_id)) : ?>
    <ul id="pages">
        <?php wp_list_pages("title_li=&depth=1"); ?>
    </ul>
<?php endif; ?>



    <?php

// Level 1 Subpages
$current_page_id = get_the_ID();
if (get_post($current_page_id)->post_parent == 0) {
    $subpages = get_pages(array(
        'child_of'    => $current_page_id,
        'parent'      => $current_page_id,
        'sort_column' => 'menu_order'
    ));

    if (!empty($subpages)) {
        echo '<h2>Subpages</h2>';
        echo '<ul class="subpage-list">';
        foreach ($subpages as $subpage) {
            echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a></li>';
        }
        echo '</ul>';
    }
}

// Call the function to list level one subpages
list_level_one_subpages();


// Start the custom query to get Author 3's posts
// Check if this is the blog page
if (is_home() && !is_front_page()) {
    $author_query = new WP_Query(array(
        'author' => 3, // Author ID of Author 3
        'post_type' => 'post', // Specify post type (e.g., 'post' for regular blog posts)
    ));

    // Check if there are posts by Author 3
    if ($author_query->have_posts()) :
        while ($author_query->have_posts()) :
            $author_query->the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <?php
                        printf(
                            esc_html__('Posted on %s', 'newTheme'),
                            '<span class="posted-on">' . get_the_date() . '</span>'
                        );
                        ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>

        <?php endwhile; ?>

        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'prev_text' => esc_html__('Previous', 'newTheme'),
                'next_text' => esc_html__('Next', 'newTheme'),
            ));
            ?>
        </div>

    <?php else : ?>

        <p><?php echo esc_html__('No posts found by Author 3.', 'newTheme'); ?></p>

    <?php endif;

    // Restore the main query
    wp_reset_postdata();
}
?>




<?php


// Start the custom query to get Author 4's posts
// Check if this is the blog page
if (is_home() && !is_front_page()) {
    $author_query = new WP_Query(array(
        'author' => 4, // Author ID of Author 4
        'post_type' => 'post', // Specify post type (e.g., 'post' for regular blog posts)
    ));

    // Check if there are posts by Author 4
    if ($author_query->have_posts()) :
        while ($author_query->have_posts()) :
            $author_query->the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <?php
                        printf(
                            esc_html__('Posted on %s', 'newTheme'),
                            '<span class="posted-on">' . get_the_date() . '</span>'
                        );
                        ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>

        <?php endwhile; ?>

        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'prev_text' => esc_html__('Previous', 'newTheme'),
                'next_text' => esc_html__('Next', 'newTheme'),
            ));
            ?>
        </div>

    <?php else : ?>

        <p><?php echo esc_html__('No posts found by Author 4.', 'newTheme'); ?></p>

    <?php endif;

    // Restore the main query
    wp_reset_postdata();
}
?>

<?php

$blog_page_id = 1925;

// Get the current page's ID
$current_page_id = get_the_ID();

if ($current_page_id === $blog_page_id) {
    // This is the blog page, so display your content here
    ?>
    <p>Explore posts by:</p>
    <ul>
        <li><a href="<?php echo get_author_posts_url(3); ?>">Author 3</a></li>
        <li><a href="<?php echo get_author_posts_url(4); ?>">Author 4</a></li>
    </ul>

    <section class="authors-blog-posts">
        <h2>Blog Posts by Authors</h2>
        <ul>
            <?php
            $author_ids = array(3, 4); // Replace with the author IDs you want to include
            $args = array(
                'author__in' => $author_ids,
                'post_type' => 'post', // Specify the post type as 'post' for regular blog posts
            );
            $author_posts = new WP_Query($args);

            if ($author_posts->have_posts()) :
                while ($author_posts->have_posts()) : $author_posts->the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            <?php endif;

            wp_reset_postdata();
            ?>
        </ul>
    </section>
    <?php
} else {
    // This is not the blog page, you can add code for other pages here
}
?>



<?php

$blog_page_id = 1922; // The parent page ID

// Get the current page's ID
$current_page_id = get_the_ID();

if ($current_page_id === $blog_page_id) {
    // This is the blog page, so display your content here
    $args = array(
        'child_of'    => $blog_page_id, // List subpages of the blog page
        'depth'       => 3,             // Display all sub-levels
        'sort_column' => 'menu_order',  // Sort by menu order
        'title_li'    => '',            // Remove the default 'Pages' title
    );

    echo '<ul>';
    wp_list_pages($args);
    echo '</ul>';
}
?>


<?php

if ($post->post_parent == 0) {
    // Get the ID of the current page
    $parent_page_id = get_the_ID();

    // Get the subpages of the current page
    $subpages = get_pages(array('child_of' => $parent_page_id, 'parent' => $parent_page_id, 'sort_column' => 'menu_order'));

    if ($subpages) {
        echo '<ul class="subpage-list">';
        foreach ($subpages as $subpage) {
            // Display the subpage
            echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a></li>';
        }
        echo '</ul>';
    }
}
?>



<?php

$blog_page_id = 1922; // The parent page ID

// Get the current page's ID
$current_page_id = get_the_ID();

if ($current_page_id === $blog_page_id) {
    // This is the blog page, so display your content here
    $args = array(
        'child_of'    => $blog_page_id, // List subpages of the blog page
        'depth'       => 1,             // Display all sub-levels
        'sort_column' => 'menu_order',  // Sort by menu order
        'title_li'    => '',            // Remove the default 'Pages' title
    );

    $subpages = get_pages($args);

    if ($subpages) {
        echo '<ul>';
        wp_list_pages($args);
        echo '</ul>';
    } else {
        echo 'No subpages found for this blog.';
    }
}
?>





<?php
// Get the current page's ID
$current_page_id = get_the_ID();

// Get subpages of the current page
$subpages = get_pages(array('child_of' => $current_page_id, 'parent' => $current_page_id, 'sort_column' => 'menu_order'));

if (!empty($subpages)) {
    // Start an unordered list
    echo '<ul class="subpage-list">';
    
    // Loop through each subpage and display it
    foreach ($subpages as $subpage) {
        echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a></li>';
    }

    // Close the unordered list
    echo '</ul>';
}
?>


















<?php endwhile; // End the loop. ?>

