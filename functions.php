<?php

$child_blocks = array(
    'rooms',
);

// add google font
function add_google_fonts() {
    wp_enqueue_style( 'Fira Sans', 'https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;700;900&display=swap', false );
    wp_enqueue_style( 'Libre Baskerville', 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// register custom blocks

add_action('init', 'register_child_acf_blocks', 5);

function register_child_acf_blocks() {

    global $child_blocks;

    foreach ($child_blocks as $block) {
        // console_log(register_block_type( get_theme_file_path( 'partials/blocks/' . $block ) ));
        register_block_type( get_theme_file_path( 'partials/blocks/' . $block ) );
    }
}

// add custom blocks to whitelist

add_filter( 'allowed_block_types_all', 'switch_child_allowed_block_types', 20, 2 );
function switch_child_allowed_block_types( $allowed_blocks ) {

    global $child_blocks;

    // $allowed_blocks = array();

    foreach ($child_blocks as $block) {
        $allowed_blocks[] = 'switch/' . $block;
    }

    console_log($allowed_blocks);

    return $allowed_blocks;
}
?>