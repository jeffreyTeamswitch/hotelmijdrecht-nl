<?php

$background = get_field('background');
$id = get_field('id');
$date_today = date('Y-m-d');
$date_tomorrow = new DateTime('tomorrow');
$date_tomorrow = date_format($date_tomorrow, 'Y-m-d');
$post_type = get_post_type();
$page_id = get_the_ID();
$room_id = '';

if ($post_type == 'rooms') {
	$room_id = get_field('room_id', $page_id);
}

?>
<section id="<?= $id ?>" class="book booking-form book--<?= $background ?>">
	<div class="wrapper">
		<form action="https://reservations.cubilis.eu/5528/Rooms/Select?" method="get" target="_blank" novalidate="novalidate">

			<input type="text" name="Room" class="display_none" value="<?= $room_id ?>">
			<input type="date" name="Arrival" value="<?= date("Y-m-d"); ?>" placeholder="<?= date("Y-m-d"); ?>">
			<input type="date" name="Departure" value="<?= $date_tomorrow ?>" placeholder="<?= $date_tomorrow ?>">
			<div class="select">
				<select name="people" id="select_people" placeholder="Personen">
					<?php if ( have_rows('select_options') ) : ?>
						<?php while( have_rows('select_options') ) : the_row(); 
							$option = get_sub_field('option');
							?>
							<option value="1"><?= $option ?></option>
						<?php endwhile; ?>
					<?php endif; ?>
				</select>
			</div>
			<input type="submit" value="Kamer boeken" class="button">
		</form>
	</div>
</section>

<?php

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_646e16e5e4a59',
		'title' => 'Block: Book',
		'fields' => array(
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
						'key' => 'field_646e1c27bdd1c',
						'label' => 'Option',
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
						'default_value' => '1 adult',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_646e1c1fbdd1b',
					),
				),
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



?>