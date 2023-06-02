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

$lang = apply_filters( 'wpml_current_language', NULL );
$lang_upper = strtoupper($lang);

$title = get_field('booking_title');
$calendar_one = get_field('calendar_one_title');
$calendar_two = get_field('calendar_two_title');
$select_title = get_field('select_title');
$button = get_field('button_text');

$coupon = get_field('coupon_code');
$coupon_title = get_field('coupon_title');
$coupon_content = get_field('coupon_text');

?>
<section id="<?= $id ?>" class="book booking-form book--<?= $background ?>">
	<div class="wrapper">
		<?php if ($title) { ?>
			<h3><?= $title ?></h3>
		<?php } ?>
		<form action="https://reservations.cubilis.eu/5528/Rooms/Select?" method="get" target="_blank" novalidate="novalidate">
			<!-- room id (display none) -->
			<input type="text" name="Room" class="display_none" value="<?= $room_id ?>">
			<input type="text" name="Language" class="display_none" value="<?= $lang .'-'. $lang_upper ?>">

			<!-- calandar 1 -->
			<div>
				<p><?= $calendar_one ?></p>
				<input type="date" name="Arrival" value="<?= date("Y-m-d"); ?>" placeholder="<?= date("Y-m-d"); ?>">
			</div>

			<!-- calandar 2 -->
			<div>
				<p><?= $calendar_two ?></p>
				<input type="date" name="Departure" value="<?= $date_tomorrow ?>" placeholder="<?= $date_tomorrow ?>">
			</div>

			<!-- select -->
			<div>
				<p><?= $select_title ?></p>
				<div class="select">
					<select name="people" id="select_people" placeholder="Personen">
						<?php if ( have_rows('select_options') ) : ?>
							<?php while( have_rows('select_options') ) : the_row(); 
								$option = get_sub_field('option');
								$quantity = get_sub_field('quantity');
								?>
								<option value="<?= $quantity ?>"><?= $quantity.' '.$option ?></option>
							<?php endwhile; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>

			<?php if ($coupon) { ?>
				<div id="promotiecode-container">
					<p><?= $coupon_title ?></p>
					<h4 id="promotiecode-title" style="cursor: pointer;" onclick="showPromo()"><?= $coupon_content ?></h4>
					<input style="display: none;" id="promotiecode" type="text" name="discountcode"  placeholder="<?= $coupon_title ?>">
				</div>

				<script>
					function showPromo() {
						document.getElementById("promotiecode").style.display = "block";
						document.getElementById("promotiecode-title").style.display = "none";
						document.getElementById("promotiecode-container").style.width = "100%";
					}
				</script>
			<?php } ?>

			<input type="submit" value="<?= $button ?>" class="button">
		</form>
	</div>
</section>

<?php

?>