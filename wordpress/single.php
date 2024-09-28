<?php
// Single post navigation
if ( is_singular('post') ) : ?>

    <nav id="nav-below" class="navigation post-navigation" role="navigation">
        <div class="nav-previous"><?php previous_post_link('%link', '« %title'); ?></div>
        <div class="nav-next"><?php next_post_link('%link', '%title »'); ?></div>
    </nav><!-- #nav-below -->

<?php endif; ?> 



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <h2><?php the_title(); ?></h2>
        <p class="author">
            Posted by <?php the_author_posts_link(); ?>
        </p>
        <!-- The rest of your post content goes here -->
    </div>
<?php endwhile; else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>



<?php
// Start the main WordPress loop.
if (have_posts()) : 
    while (have_posts()) : the_post(); ?>

        <!-- Your existing page content goes here -->

    <?php endwhile; // End of the main loop.
    
    // Fetch and display level 1 subpages
    $current_page_id = get_the_ID();
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

endif;
?>
