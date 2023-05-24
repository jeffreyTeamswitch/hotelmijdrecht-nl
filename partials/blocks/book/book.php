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

?>