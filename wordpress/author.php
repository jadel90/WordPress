<?php
get_header(); // Include your header template if needed
?>

<div id="primary" class="content-area">
    <main id="main" class "site-main">
        <?php
        // Display the author's name and description
        the_post(); // Move to the first post (which is the author's page)
        ?>
        <header class="author-header">
            <?php
            // Check the author's nicename and display the corresponding image
            $author_nicename = get_the_author_meta('nicename');
            if ($author_nicename === 'jane_doe') {
                // Display Jane Doe's image
                echo '<div class="author-bg" style="height: 260px; width: 194px; background-image: url(\'' . esc_url(get_template_directory_uri() . '/woman_image.png') . '\'); background-repeat: no-repeat;"></div>';
            } 
            
            elseif ($author_nicename === 'john_smith') {
                // Display John Smith's image
                echo '<div class="author-bg" style="height: 260px; width: 194px; background-image: url(\'' . esc_url(get_template_directory_uri() . '/man_image.png') . '\'); background-repeat: no-repeat;"></div>';
            }
            ?>

            <h1 class="author-title"><?php the_author(); ?></h1>
            <?php if (get_the_author_meta('description')) : ?>
                <div class="author-description">
                    <?php the_author_meta('description'); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php
        // Display the author's posts
        rewind_posts(); // Reset the loop
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            <span class="posted-on"><?php the_time(get_option('date_format')); ?></span>
                        </div>
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php esc_html_e('No posts found.', 'newTheme'); ?></p>
        <?php endif; ?>
    </main>
</div>

<?php
get_sidebar(); // Include your sidebar template if needed
get_footer(); // Include your footer template if needed
?>
