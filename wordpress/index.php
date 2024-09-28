<html>
<head>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <title><?php bloginfo('name'); ?></title>
</head>
<body>
<h1>
    <a href="<?php echo get_home_url(); ?>">
        <!-- <img src="<?php echo get_template_directory_uri(); ?>/x.png"> -->
        <?php bloginfo('name'); ?>
    </a>
</h1>
<p><?php bloginfo('description'); ?></p>
<ul id="pages">
    <?php wp_list_pages("title_li=&depth=1"); ?>
</ul>
<?php echo get_search_form(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-meta">
                <span class="author">
                    <p>By: <?php the_author_posts_link(); ?></p>
                </span>
                <span class="date">
                <p>Posted on: <?php the_time('F j, Y'); ?></p>
                </span>
                <span class="categories">
                <p>Categories: <?php the_category(', '); ?></p>
                </span>
                <!-- You can add more meta information here -->
            </div>
            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </article>
    <?php endwhile; ?>
    <!-- Add pagination here if needed -->


    <nav id="nav-below" class="navigation page-navigation" role="navigation">
        <div class="nav-previous"><?php next_posts_link('« Older Posts'); ?></div>
        <div class="nav-next"><?php previous_posts_link('Newer Posts »'); ?></div>
    </nav><!-- #nav-below -->

<?php else : ?>
    <p><?php _e('No posts found.', 'newTheme'); ?></p>
<?php endif; ?>
<div id="postsnav"><?php posts_nav_link(); ?></div>



<?php
// Display the top-level pages menu
wp_nav_menu(array(
    'theme_location' => 'top-level-pages-menu', 
    'menu_class'     => 'top-level-menu', 
));
?>



<?php






// new code




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



<!-- level 1 page -->

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



<?php get_sidebar(); ?> 
<?php get_footer(); ?>

</body>
</html>
