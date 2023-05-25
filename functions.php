<?php
// Settings vars
    add_action( 'after_setup_theme', 'websquad_child_theme_settings' );

    function websquad_child_theme_settings(){
        global $lang_switcher;
        $lang_switcher = true; // instead of showing the date, show the subtitle under 'event' post types.
    }
//
// Scripts
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


    // room acf fields 

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
                array(
                    'key' => 'field_646ccd97ca186',
                    'label' => 'Style',
                    'name' => 'style',
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
                        'three' => 'Three',
                        'four' => 'Four',
                    ),
                    'default_value' => 'four',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
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
    add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_646e16e5e4a59',
            'title' => 'Block: Book',
            'fields' => array(
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

?>