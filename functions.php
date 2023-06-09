<?php
// Settings vars
    add_action( 'after_setup_theme', 'websquad_child_theme_settings' );

    function websquad_child_theme_settings(){
        global $lang_switcher;
        $lang_switcher = true; // instead of showing the date, show the subtitle under 'event' post types.
    };


//
// Scripts
    function add_ratebox() {
		wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/vendor/jquery-3.6.1.min.js');
        wp_enqueue_script('ratebox', 'https://static.cubilis.eu/js/ratebox.bundle.js');
        wp_enqueue_script('child-main', get_stylesheet_directory_uri() . '/js/main.js' , array('ratebox'), wp_get_theme()->get('Version') );
    };

    add_action( 'wp_enqueue_scripts', 'add_ratebox' );
//
// Custom post type
    $child_blocks = array(
        'rooms',
        'book',
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
//
// Rooms
    // room post type

    add_action( 'init', function() {
        register_post_type( 'rooms', array(
            'labels' => array(
                'name' => 'Rooms',
                'singular_name' => 'Room',
                'menu_name' => 'Rooms',
                'all_items' => 'All Rooms',
                'edit_item' => 'Edit room',
                'view_item' => 'View room',
                'view_items' => 'View Rooms',
                'add_new_item' => 'Add New room',
                'new_item' => 'New room',
                'parent_item_colon' => 'Parent room:',
                'search_items' => 'Search Rooms',
                'not_found' => 'No rooms found',
                'not_found_in_trash' => 'No rooms found in Trash',
                'archives' => 'room Archives',
                'attributes' => 'room Attributes',
                'insert_into_item' => 'Insert into room',
                'uploaded_to_this_item' => 'Uploaded to this room',
                'filter_items_list' => 'Filter rooms list',
                'filter_by_date' => 'Filter rooms by date',
                'items_list_navigation' => 'Rooms list navigation',
                'items_list' => 'Rooms list',
                'item_published' => 'room published.',
                'item_published_privately' => 'room published privately.',
                'item_reverted_to_draft' => 'room reverted to draft.',
                'item_scheduled' => 'room scheduled.',
                'item_updated' => 'room updated.',
                'item_link' => 'room Link',
                'item_link_description' => 'A link to a room.',
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array(
                0 => 'title',
                1 => 'editor',
                2 => 'custom-fields',
            ),
            'delete_with_user' => false,
        ) );
    } );

    // room (post-type) info acf fields 

    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_646c74839cb59',
            'title' => 'Room',
            'fields' => array(
                array(
                    'key' => 'field_646c7666daef4',
                    'label' => 'Room information',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_646c74831731a',
                    'label' => 'Room ID',
                    'name' => 'room_id',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646c749d2e254',
                    'label' => 'Room images',
                    'name' => 'room_images',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'table',
                    'pagination' => 0,
                    'min' => 0,
                    'max' => 0,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_646c74ad2e255',
                            'label' => 'Room image',
                            'name' => 'image',
                            'aria-label' => '',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                            'preview_size' => 'medium',
                            'parent_repeater' => 'field_646c749d2e254',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_646cc46a01372',
                    'label' => 'Room description',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_646cc47701373',
                    'label' => 'Room description',
                    'name' => 'room_description',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'placeholder' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_646cc49e01374',
                    'label' => 'Room facilities',
                    'name' => 'room_facilities',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'table',
                    'pagination' => 0,
                    'min' => 0,
                    'max' => 0,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_646cc4c201375',
                            'label' => 'Facilitie',
                            'name' => 'facilitie',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_646cc49e01374',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'rooms',
                    ),
                ),
            ),
            'menu_order' => -1,
            'position' => 'normal',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                0 => 'the_content',
                1 => 'excerpt',
                2 => 'discussion',
                3 => 'comments',
                4 => 'revisions',
                5 => 'slug',
                6 => 'author',
                7 => 'format',
                8 => 'featured_image',
                9 => 'categories',
                10 => 'tags',
                11 => 'send-trackbacks',
            ),
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    } );


    // rooms block acf fields

    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }
    
        acf_add_local_field_group( array(
            'key' => 'group_646ccd97c64a8',
            'title' => 'Block: Rooms',
            'fields' => array(
                array(
                    'key' => 'field_6470ad830946e',
                    'label' => 'Introduction',
                    'name' => 'introduction',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_646ccd97ca166',
                    'label' => 'Align',
                    'name' => 'align',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'left' => 'Left',
                        'center' => 'Center',
                        'right' => 'Right',
                    ),
                    'default_value' => 'left',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_646ccd97ca16c',
                    'label' => 'Background',
                    'name' => 'background',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'white' => 'White',
                        'grey' => 'Grey',
                        'black' => 'Black',
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                    ),
                    'default_value' => 'white',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_646ccd97ca173',
                    'label' => 'Color',
                    'name' => 'color',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'basic' => 'Basic',
                    ),
                    'default_value' => 'basic',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_646ccd97ca179',
                    'label' => 'Id',
                    'name' => 'id',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'switch/rooms',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    } );

//
// Book

    // add_action( 'acf/include_fields', function() {
    //     if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    //         return;
    //     }

    //     acf_add_local_field_group( array(
    //         'key' => 'group_646e16e5e4a59',
    //         'title' => 'Block: Book',
    //         'fields' => array(
    //             array(
    //                 'key' => 'field_64761b2362938',
    //                 'label' => 'Title',
    //                 'name' => 'booking_title',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => '',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e2400170c2',
    //                 'label' => 'Input 1',
    //                 'name' => 'calendar_one_title',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 1,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => 'Arrive by',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e244d170c3',
    //                 'label' => 'Input 2',
    //                 'name' => 'calendar_two_title',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 1,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => 'Departure at',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e23ab6b0e0',
    //                 'label' => 'Select title',
    //                 'name' => 'select_title',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 1,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => 'Guests',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e1c1fbdd1b',
    //                 'label' => 'Select options',
    //                 'name' => 'select_options',
    //                 'aria-label' => '',
    //                 'type' => 'repeater',
    //                 'instructions' => '',
    //                 'required' => 1,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'layout' => 'table',
    //                 'pagination' => 0,
    //                 'min' => 3,
    //                 'max' => 0,
    //                 'collapsed' => '',
    //                 'button_label' => 'Add Row',
    //                 'rows_per_page' => 20,
    //                 'sub_fields' => array(
    //                     array(
    //                         'key' => 'field_646e1ff0dc6fd',
    //                         'label' => 'Quantity',
    //                         'name' => 'quantity',
    //                         'aria-label' => '',
    //                         'type' => 'number',
    //                         'instructions' => '',
    //                         'required' => 0,
    //                         'conditional_logic' => 0,
    //                         'wrapper' => array(
    //                             'width' => '',
    //                             'class' => '',
    //                             'id' => '',
    //                         ),
    //                         'default_value' => '',
    //                         'min' => '',
    //                         'max' => '',
    //                         'placeholder' => '',
    //                         'step' => '',
    //                         'prepend' => '',
    //                         'append' => '',
    //                         'parent_repeater' => 'field_646e1c1fbdd1b',
    //                     ),
    //                     array(
    //                         'key' => 'field_646e1c27bdd1c',
    //                         'label' => 'Name',
    //                         'name' => 'option',
    //                         'aria-label' => '',
    //                         'type' => 'text',
    //                         'instructions' => '',
    //                         'required' => 0,
    //                         'conditional_logic' => 0,
    //                         'wrapper' => array(
    //                             'width' => '',
    //                             'class' => '',
    //                             'id' => '',
    //                         ),
    //                         'default_value' => 'adult',
    //                         'maxlength' => '',
    //                         'placeholder' => '',
    //                         'prepend' => '',
    //                         'append' => '',
    //                         'parent_repeater' => 'field_646e1c1fbdd1b',
    //                     ),
    //                 ),
    //             ),
    //             array(
    //                 'key' => 'field_6479bb259fabd',
    //                 'label' => 'Coupon Code',
    //                 'name' => 'coupon_code',
    //                 'aria-label' => '',
    //                 'type' => 'true_false',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'message' => '',
    //                 'default_value' => 0,
    //                 'ui' => 0,
    //                 'ui_on_text' => '',
    //                 'ui_off_text' => '',
    //             ),
    //             array(
    //                 'key' => 'field_6479bb419fabe',
    //                 'label' => 'Coupon title',
    //                 'name' => 'coupon_title',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => array(
    //                     array(
    //                         array(
    //                             'field' => 'field_6479bb259fabd',
    //                             'operator' => '==',
    //                             'value' => '1',
    //                         ),
    //                     ),
    //                 ),
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => '',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_6479bb579fabf',
    //                 'label' => 'Coupon text',
    //                 'name' => 'coupon_text',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => array(
    //                     array(
    //                         array(
    //                             'field' => 'field_6479bb259fabd',
    //                             'operator' => '==',
    //                             'value' => '1',
    //                         ),
    //                     ),
    //                 ),
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => '',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e170c6805a',
    //                 'label' => 'Button text',
    //                 'name' => 'button_text',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 1,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => 'Book a room',
    //                 'maxlength' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e16e5e83e1',
    //                 'label' => 'Background',
    //                 'name' => 'background',
    //                 'aria-label' => '',
    //                 'type' => 'select',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'choices' => array(
    //                     'white' => 'White',
    //                     'grey' => 'Grey',
    //                     'black' => 'Black',
    //                     'primary' => 'Primary',
    //                     'secondary' => 'Secondary',
    //                 ),
    //                 'default_value' => 'white',
    //                 'allow_null' => 0,
    //                 'multiple' => 0,
    //                 'ui' => 0,
    //                 'return_format' => 'value',
    //                 'ajax' => 0,
    //                 'placeholder' => '',
    //             ),
    //             array(
    //                 'key' => 'field_646e16e5e83ee',
    //                 'label' => 'Id',
    //                 'name' => 'id',
    //                 'aria-label' => '',
    //                 'type' => 'text',
    //                 'instructions' => '',
    //                 'required' => 0,
    //                 'conditional_logic' => 0,
    //                 'wrapper' => array(
    //                     'width' => '',
    //                     'class' => '',
    //                     'id' => '',
    //                 ),
    //                 'default_value' => '',
    //                 'placeholder' => '',
    //                 'prepend' => '',
    //                 'append' => '',
    //                 'maxlength' => '',
    //             ),
    //         ),
    //         'location' => array(
    //             array(
    //                 array(
    //                     'param' => 'block',
    //                     'operator' => '==',
    //                     'value' => 'switch/book',
    //                 ),
    //             ),
    //         ),
    //         'menu_order' => 0,
    //         'position' => 'normal',
    //         'style' => 'default',
    //         'label_placement' => 'top',
    //         'instruction_placement' => 'label',
    //         'hide_on_screen' => '',
    //         'active' => true,
    //         'description' => '',
    //         'show_in_rest' => 0,
    //     ) );
    // } );

    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }
    
        acf_add_local_field_group( array(
            'key' => 'group_646e16e5e4a59',
            'title' => 'Block: Book',
            'fields' => array(
                array(
                    'key' => 'field_64761b2362938',
                    'label' => 'Title',
                    'name' => 'booking_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e2400170c2',
                    'label' => 'Input 1',
                    'name' => 'calendar_one_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Arrive by',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e244d170c3',
                    'label' => 'Input 2',
                    'name' => 'calendar_two_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Departure at',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e23ab6b0e0',
                    'label' => 'Select title',
                    'name' => 'select_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Guests',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e1c1fbdd1b',
                    'label' => 'Select options',
                    'name' => 'select_options',
                    'aria-label' => '',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'table',
                    'pagination' => 0,
                    'min' => 3,
                    'max' => 0,
                    'collapsed' => '',
                    'button_label' => 'Add Row',
                    'rows_per_page' => 20,
                    'sub_fields' => array(
                        array(
                            'key' => 'field_646e1ff0dc6fd',
                            'label' => 'Quantity',
                            'name' => 'quantity',
                            'aria-label' => '',
                            'type' => 'number',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'min' => '',
                            'max' => '',
                            'placeholder' => '',
                            'step' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_646e1c1fbdd1b',
                        ),
                        array(
                            'key' => 'field_646e1c27bdd1c',
                            'label' => 'Name',
                            'name' => 'option',
                            'aria-label' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => 'adult',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'parent_repeater' => 'field_646e1c1fbdd1b',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_6479bb259fabd',
                    'label' => 'Coupon Code',
                    'name' => 'coupon_code',
                    'aria-label' => '',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                array(
                    'key' => 'field_6479bb419fabe',
                    'label' => 'Coupon title',
                    'name' => 'coupon_title',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_6479bb259fabd',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_6479bb579fabf',
                    'label' => 'Coupon text',
                    'name' => 'coupon_text',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_6479bb259fabd',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e170c6805a',
                    'label' => 'Button text',
                    'name' => 'button_text',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Book a room',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_646e16e5e83e1',
                    'label' => 'Background',
                    'name' => 'background',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'white' => 'White',
                        'grey' => 'Grey',
                        'black' => 'Black',
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                    ),
                    'default_value' => 'white',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_646e16e5e83ee',
                    'label' => 'Id',
                    'name' => 'id',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_6481cf9635cf6',
                    'label' => 'Arrangement',
                    'name' => 'arrangement',
                    'aria-label' => '',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 0,
                    'message' => '',
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                array(
                    'key' => 'field_6481cfbb35cf7',
                    'label' => 'Arrangement ID',
                    'name' => 'arrangement_id',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_6481cf9635cf6',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'switch/book',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    } );

//
// Custom strings (hotel)
    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_646f1f16ddf70',
            'title' => 'Options (hotel)',
            'fields' => array(
                array(
                    'key' => 'field_646f1f1779241',
                    'label' => 'Strings (hotel)',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_646f1f2c79242',
                    'label' => 'Room card button',
                    'name' => 'room_book_button',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => 'Book a room',
                    'prepend' => '',
                    'append' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'seamless',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    } );

//
// Vacancies

    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_6481daf7a6302',
            'title' => 'Vacancy',
            'fields' => array(
                array(
                    'key' => 'field_6481db07000c4',
                    'label' => 'Vacancy information',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_6481daf7000c3',
                    'label' => 'Description',
                    'name' => 'vacancy_description',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'placeholder' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_6481db11000c5',
                    'label' => 'Type',
                    'name' => 'vacancy_type',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'FULL_TIME' => 'Full time',
                        'PART_TIME' => 'Part time',
                        'CONTRACTOR' => 'Contractor',
                        'TEMPORARY' => 'Temporary',
                        'INTERN' => 'Intern',
                        'VOLUNTEER' => 'Volunteer',
                        'PER_DIEM' => 'Per diem',
                        'OTHER' => 'Other',
                    ),
                    'default_value' => false,
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_6481dbc7000c6',
                    'label' => 'Salary indication',
                    'name' => 'vacancy_salary_hour',
                    'aria-label' => '',
                    'type' => 'number',
                    'instructions' => 'Per hour',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'placeholder' => '',
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'vacancy',
                    ),
                ),
            ),
            'menu_order' => 1,
            'position' => 'side',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    } );

    add_action( 'init', function() {
        register_post_type( 'vacancy', array(
            'labels' => array(
                'name' => 'Vacancies',
                'singular_name' => 'Vacancy',
                'menu_name' => 'Vacancies',
                'all_items' => 'All Vacancies',
                'edit_item' => 'Edit Vacancy',
                'view_item' => 'View Vacancy',
                'view_items' => 'View Vacancies',
                'add_new_item' => 'Add New Vacancy',
                'new_item' => 'New Vacancy',
                'parent_item_colon' => 'Parent Vacancy:',
                'search_items' => 'Search Vacancies',
                'not_found' => 'No vacancies found',
                'not_found_in_trash' => 'No vacancies found in Trash',
                'archives' => 'Vacancy Archives',
                'attributes' => 'Vacancy Attributes',
                'insert_into_item' => 'Insert into vacancy',
                'uploaded_to_this_item' => 'Uploaded to this vacancy',
                'filter_items_list' => 'Filter vacancies list',
                'filter_by_date' => 'Filter vacancies by date',
                'items_list_navigation' => 'Vacancies list navigation',
                'items_list' => 'Vacancies list',
                'item_published' => 'Vacancy published.',
                'item_published_privately' => 'Vacancy published privately.',
                'item_reverted_to_draft' => 'Vacancy reverted to draft.',
                'item_scheduled' => 'Vacancy scheduled.',
                'item_updated' => 'Vacancy updated.',
                'item_link' => 'Vacancy Link',
                'item_link_description' => 'A link to a vacancy.',
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array(
                0 => 'title',
                1 => 'editor',
                2 => 'page-attributes',
                3 => 'custom-fields',
            ),
            'delete_with_user' => false,
        ) );
    } );

//
// google jobs

    // include 'google-jobs.php';

//
?>