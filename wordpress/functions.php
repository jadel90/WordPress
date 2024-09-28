<?php
// Enqueue custom styles and scripts
function enqueue_custom_styles_and_scripts() {
    // Enqueue styles
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/custom.css', array(), '1.0.0', 'all');

    // Enqueue scripts
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles_and_scripts');

// Register custom navigation menus
function register_custom_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'newTheme'),
        'secondary-menu' => __('Secondary Menu', 'newTheme'),
    ));
}
add_action('init', 'register_custom_menus');

// Register custom post types
function create_custom_post_type() {
    register_post_type('custom_post', array(
        'labels' => array(
            'name' => __('Custom Posts', 'newTheme'),
            'singular_name' => __('Custom Post', 'newTheme'),
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
    ));
}
add_action('init', 'create_custom_post_type');

// Register custom sidebar
function register_custom_sidebar() {
    register_sidebar(array(
        'name' => __('Custom Sidebar', 'newTheme'),
        'id' => 'custom-sidebar',
        'description' => __('A custom sidebar area', 'newTheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'register_custom_sidebar');

// Enqueue custom styles for specific pages
function enqueue_custom_page_styles() {
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/custom-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_page_styles');

// Enqueue background image for specific author page

function enqueue_custom_styles() {
    if (is_author('jane-doe')) {
        wp_enqueue_style('custom-author-page', get_stylesheet_directory_uri() . '/custom-author-page.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


if (is_front_page()) {
    ?>
    <ul class="page-list">
        <?php
        $pages = get_pages(array('sort_column' => 'menu_order'));

        foreach ($pages as $page) {
            $parent_id = $page->post_parent;

            // Display only top-level pages
            if ($parent_id === 0) {
                echo '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';

                // Check if the current top-level page has subpages
                $subpages = get_pages(array('child_of' => $page->ID, 'sort_column' => 'menu_order'));
                if ($subpages) {
                    echo '<ul class="subpage-list">';
                    foreach ($subpages as $subpage) {
                        echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a></li>';
                    }
                    echo '</ul>';
                }
            }
        }
        ?>
    </ul>
    <?php
}

function enqueue_customizer_script() {
    wp_enqueue_script('customizer-script', get_template_directory_uri() . '/customizer.js', array('jquery', 'customize-preview'), '', true);
}
add_action('customize_preview_init', 'enqueue_customizer_script');



function customizer_color_theme_settings($wp_customize) {
    // Add a section for color theme settings
    $wp_customize->add_section('color_theme', array(
        'title'    => __('Color Theme', 'newTheme'),
        'priority' => 30,
    ));

    // Add a setting for color theme
    $wp_customize->add_setting('selected_color_theme', array(
        'default'   => 'default', // Default color theme
        'transport' => 'refresh', // Live preview
    ));

    // Add control for color theme
    $wp_customize->add_control('selected_color_theme', array(
        'label'    => __('Select Color Theme', 'newTheme'),
        'section'  => 'color_theme',
        'type'     => 'radio', // Use 'select' for dropdown
        'choices'  => array(
            'default'     => __('Default', 'newTheme'),
            'black_white' => __('Pink on White', 'newTheme'),
            'white_black' => __('White on Pink', 'newTheme'),
        ),
    ));
}
add_action('customize_register', 'customizer_color_theme_settings');


//list subpages
function list_subpages() {
    $parent_page_id = 1922; // Replace with the ID of the parent page

    $args = array(
        'child_of'     => $parent_page_id,
        'depth'        => 1,         // Show only direct children
        'sort_column'  => 'menu_order', // You can change to 'post_title' or 'post_date'
        'title_li'     => ''
        
    );

    echo '<ul>';
    wp_list_pages($args);
    echo '</ul>';
}

// list subpages



// Add this function to your theme's functions.php file
function list_level_one_subpages() {
    $current_page_id = get_the_ID();
    if (get_post($current_page_id)->post_parent == 0) {
        $subpages = get_pages(array(
            'child_of'    => $current_page_id,
            'parent'      => $current_page_id,
            'sort_column' => 'menu_order'
        ));

        if (!empty($subpages)) {
            echo '<ul class="subpage-list">';
            foreach ($subpages as $subpage) {
                echo '<li><a href="' . get_permalink($subpage->ID) . '">' . $subpage->post_title . '</a></li>';
            }
            echo '</ul>';
        }
    }
}








function my_custom_theme_setup() {
    // Register Navigation Menu
    register_nav_menus(array(
        'top-level-pages-menu' => 'Top Level Pages Menu', // Define your menu location key here
    ));
}
add_action('after_setup_theme', 'my_custom_theme_setup');

function enqueue_custom_navigation_style() {
    // Enqueue your custom navigation CSS
    wp_enqueue_style('custom-navigation-style', get_stylesheet_directory_uri() . '/custom-navigation.css', array(), '1.0.0');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_navigation_style');


// Enqueue Google Fonts
function enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap', false);
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');

// Widgets for sidebar and footer
function theme_widgets_init() {
    // Register Sidebar Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'newTheme'),
        'id'            => 'sidebar-widget-area',
        'description'   => esc_html__('Add widgets here to display in the sidebar.', 'newTheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Register Footer Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Footer', 'newTheme'),
        'id'            => 'footer-widget-area',
        'description'   => esc_html__('Add widgets here to display in the footer.', 'newTheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');
?>
