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

				$type = '';
				$repeater = get_field('rooms_images');
				$image = $repeater[0]['rooms_images']['sizes']['960-1-1'];
				$title = get_the_title($id);
				$text = false;
				$room_id = get_field('room_id');
				$button = get_the_permalink($id);

				?>

				<div class="card__item">

					<?php if ($image): ?>

						<div class="card__image <?php if ($type == 'video'): ?>card__image--video<?php endif; ?>">

							<a href="https://reservations.cubilis.eu/hampshire-hotel-mijdrecht/Rooms/GeneralAvailability?Language=nl-NL&Room=<?= $room_id; ?>" target="_blank">

								<img loading="lazy" src="<?= $image; ?>" alt="<?= $title; ?>">
							
							</a>

						</div>

					<?php endif; ?>

					<?php if ($title): ?>

						<div class="card__text">

							<h2><?= $title; ?></h2>

							<?php if ($text): ?>

								<p><?= $text; ?></p>

							<?php endif; ?>
						</div>

					<?php endif; ?>

					<?php if ($button): ?>

						<div class="card__button">

							<a class="button button--filled-secondary" href="https://reservations.cubilis.eu/hampshire-hotel-mijdrecht/Rooms/GeneralAvailability?Language=nl-NL&Room=<?= $room_id; ?>" target="_blank">Bekijk</a>

						</div>

					<?php endif; ?>

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

