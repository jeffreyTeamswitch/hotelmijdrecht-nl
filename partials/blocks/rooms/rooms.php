<?php 

// vars

$align = get_field('align');
$background = get_field('background');
$color = get_field('color');
$id = get_field('id');
$style = get_field('style');

?>

<section id="<?= $id; ?>" class="rooms cards card--<?= $align; ?> card--<?= $background; ?> card--<?= $color; ?> card--full card--<?= $style; ?>">
	<div class="wrapper">
			
	<?php
		$post_type = 'rooms';
		$post_per_page = get_field('card_amount');
		$post_more = get_field('card_more');
		$post_current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$post_query = new WP_Query(
			array(  
				'post_type' => $post_type,
				'post_status' => 'publish',
				'orderby' => array(
					'post_date' => 'desc', 
				),
				'posts_per_page' => $post_per_page,
				'paged' => $post_current_page
			)
		);
		$post_max_pages = $post_query->max_num_pages;
		$post_text_more = 'Laad meer';
		$post_text_loading = 'Aan het laden ...';
		$post_text_done = 'Uitgeladen';

		?>

		<div class="card__container" 
			
			data-post-type="<?= $post_type; ?>"
			data-post-per-page="<?= $post_per_page; ?>"
			data-post-max-pages="<?= $post_max_pages; ?>"
			data-post-text-more="<?= $post_text_more; ?>"
			data-post-text-loading="<?= $post_text_loading; ?>"
			data-post-text-done="<?= $post_text_done; ?>"
		
		>

			<?php
				
			while ( $post_query->have_posts() ) : $post_query->the_post();

				// vars

				$id = get_the_ID();

				$repeater = get_field('room_images', $id);
				console_log($repeater);

				$image = $repeater[0]['image']['sizes']['960-1-1'];
				$title = get_the_title($id);
				$text = get_field('room_description', $id);
				$room_id = get_field('room_id');
				// $button = get_the_permalink($id);

				?>

				<div class="card__item">

					<?php if ($image): ?>

						<div class="card__image">

							<a href="https://reservations.cubilis.eu/hampshire-hotel-mijdrecht/Rooms/GeneralAvailability?Language=nl-NL&Room=<?= $room_id; ?>" target="_blank">

								<img loading="lazy" src="<?= $image; ?>" alt="<?= $title; ?>">
							
							</a>

						</div>

					<?php endif; ?>

					<?php if ($title): ?>

						<div class="card__text">

							<h2><?= $title; ?></h2>

							<?php if ($text): ?>

								<p class="dotdotdot--4"><?= $text; ?></p>

							<?php endif; ?>
						</div>

					<?php endif; ?>

					<div class="card__button">

						<a class="button button--filled-secondary" href="https://reservations.cubilis.eu/hampshire-hotel-mijdrecht/Rooms/GeneralAvailability?Language=nl-NL&Room=<?= $room_id; ?>" target="_blank">Bekijk</a>

					</div>

				</div>

				<?php

			endwhile;

			?>

		</div>

		<?php 
		
		if ($post_more): 
		
			?>

			<div class="card__load-more">

				<button class="button button--filled-secondary <?= ($post_max_pages == 1) ? 'button--disabled' : '' ; ?>" <?= ($post_max_pages == 1) ? 'disabled' : '' ; ?>><?= ($post_max_pages == 1) ? $post_text_done : $post_text_more ; ?></button>

			</div>

			<?php 
		
		endif;

		wp_reset_postdata();
	

	?>
	</div>
</section>

<?php

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



?>