<?php
// Get the header
get_header();
?>

<main>
    <h1>Search Results for: <?php echo get_search_query(); ?></h1>

    <?php if ( have_posts() ) : ?>
        <ul class="search-results-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <li class="search-result-item">
                    <h2 class="search-result-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="search-result-meta">
                        <span class="search-result-author">
                            By: <?php the_author_posts_link(); ?>
                        </span>
                        <span class="search-result-date">
                            Posted on: <?php the_time('F j, Y'); ?>
                        </span>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>No results found for: <?php echo get_search_query(); ?></p>
    <?php endif; ?>
</main>

<?php
// Get the footer
get_footer();
?>
