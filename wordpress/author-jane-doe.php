<?php
// Include your header and other necessary template parts here
get_header();
?>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Display the author's name and description
        the_post();
        $author_name = 'Jane Doe'; // You can hardcode the author's name
        $author_description = get_the_author_meta('description');
        ?>
        <header class="author-header" 
        <div class="author-bg" style="height: 260px; width: 194px; background-image: url('<?php echo esc_url(get_template_directory_uri() . '/woman_image.png'); ?>'); background-repeat: no-repeat;"> </div>


            <h1 class="author-name"><?php echo esc_html($author_name); ?></h1>
            <?php if (!empty($author_description)) : ?>
                <div class="author-description"><?php echo esc_html($author_description); ?></div>
            <?php endif; ?>
        </header>

        <?php
        // Reset the query to start displaying the author's posts
        rewind_posts();
        // Display the author's posts
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Display the posts as needed
            endwhile;
        else :
            ?>
            <p><?php esc_html_e('No posts found.', 'newTheme'); ?></p>
        <?php endif; ?>

    </main>
</div>

<?php
// Include your footer and other necessary template parts here
get_footer();
?>
