<?php 

// vars

$card_type = get_field('card_type');
$align = get_field('align');
$background = get_field('background');
$color = get_field('color');
$id = get_field('id');
$image = get_field('image');
$style = get_field('style');

?>

<section id="<?= $id; ?>" class="cards card--<?= $align; ?> card--<?= $background; ?> card--<?= $color; ?> card--<?= $image; ?> card--<?= $style; ?>">
	<div class="wrapper">
			
	<?php
		$post_type = 'room';
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

				$repeater = get_field('rooms_images');
				console_log($repeater);

				$image = $repeater[0]['rooms_images']['sizes']['960-1-1'];
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

?>