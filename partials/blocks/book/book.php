<?php

$background = get_field('background');
$id = get_field('id');
$date_today = date('Y-m-d');
$date_tomorrow = new DateTime('tomorrow');
$date_tomorrow = date_format($date_tomorrow, 'Y-m-d');

console_log($date_today);
console_log($date_tomorrow);

?>
<section id="<?= $id ?>" class="book booking-form book--<?= $background ?>">
	<div class="wrapper">
		<form action="https://reservations.cubilis.eu/5528/Rooms/Select" method="get" target="_blank" novalidate="novalidate">
			<!-- <input type="date" name="Arrival" value="<?= $date_today ?>" placeholder="<?= $date_today ?>"> -->
			<input type="date" name="Arrival" value="<?= date("Y-m-d"); ?>" placeholder="<?= date("Y-m-d"); ?>">
			<input type="date" name="Departure" value="<?= $date_tomorrow ?>" placeholder="<?= $date_tomorrow ?>">
			<select name="people" id="select_people">
				<option value="0" selected disabled>Personen</option>
				<option value="1" >1 Volwassenen</option>
				<option value="2">2 Volwassenen</option>
				<option value="3">3 Volwassenen</option>
			</select>
			<input type="submit" value="Kamer boeken" class="button">
		</form>
	</div>
</section>