<?php 

// vars

$introduction = get_field('introduction');
$align = get_field('align');
$background = get_field('background');
$color = get_field('color');
$id = get_field('id');

$slider_id = wp_unique_id( 'reference' );

?>

<section id="<?= $id; ?>" class="rooms cards card--<?= $align; ?> card--<?= $background; ?> card--<?= $color; ?> card--full">
	<div class="wrapper">

		<?php if ($introduction) { ?>
			<div class="introduction wysiwyg wysiwyg--<?= $background; ?>">
				<?= $introduction; ?>
			</div>
		<?php } ?>

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
					'paged' => $post_current_page,
                    'suppress_filters' => false,

				)
			);
			$post_max_pages = $post_query->max_num_pages;
			$post_text_more = 'Laad meer';
			$post_text_loading = 'Aan het laden ...';
			$post_text_done = 'Uitgeladen';

			?>

			<div class="card__container room__slider slider" id="<?= $slider_id ?>" 
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

					// if (sizeof($repeater < 1)) {
					// 	continue;
					// }; 

					$image = $repeater[0]['image']['sizes']['960-1-1'];
					$title = get_the_title($id);
					$text = get_field('room_description', $id);
					$room_id = get_field('room_id', $id);
					$button_text = get_field('string_card_button', 'option') ?: 'Bekijk';
					$button_text_book = get_field('room_book_button', 'option') ?: 'Boek nu';
					// $button = get_the_permalink($id);
					$lang = apply_filters( 'wpml_current_language', NULL );
					$lang_upper = strtoupper($lang);

					?>
					<div class="slide">
						<div class="card__item">

							<?php if ($image): ?>

								<div class="card__image">

									<a href="<?= get_permalink($id) ?>" target="_blank">

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
								<a class="button button--filled-primary" href="<?= get_permalink($id) ?>"><?= $button_text ?></a>
								<a class="button button--filled-secondary" href="https://reservations.cubilis.eu/hampshire-hotel-mijdrecht/Rooms/GeneralAvailability?Language=<?= $lang .'-'. $lang_upper ?>&Room=<?= $room_id; ?>" target="_blank"><?= $button_text_book ?></a>

							</div>

						</div>
					</div>
					<?php

				endwhile;
				?>

			</div>

			<?php 

			wp_reset_postdata();
		

		?>
	</div>
	
	<script>
		if (typeof tns === 'function') {
			var slider = tns({
				container: '#<?= $slider_id ?>',
						slideBy: 1,
						mouseDrag: true,
						controls: true,
						controlsPosition: 'bottom',
						controlsText: ['', ''],
						center: false,
						lazyload: true,
						nav: false,
						loop: false,
						autoHeight: false,
						responsive: {
							0: {
								items: 1,
								// gutter: 24,
								edgePadding: 48,
							},
							960: {
								items: 2,
								// gutter: 24,
								edgePadding: 48,
							},
							1280: {
								items: 3,
								// gutter: 48,
								edgePadding: 96,
							},

							1600: {
								items: 4,
								// gutter: 48,
								edgePadding: 96,
							},
						},
			});
		} else {
			const slides = document.querySelectorAll('#<?= $slider_id; ?> > *');
			// remove all but first slide
			slides.forEach((slide, index) => {
				if (index > 0) {
					slide.classList.add('display-none');
				}
			});
		}
	</script>
</section>