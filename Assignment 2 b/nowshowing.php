<?php
	session_start();
	$page = "nowshowing.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/links.php") ?>

		<title> Silverado | Now Showing </title>

	</head>
	<!------------------------------------------------------------------------------------>
	<body>
		<?php include_once("includes/header.php") ?>

		<?php include_once("includes/nav.php") ?>

		<!-- Entire Movie Panel -->
		<div id="allmovies">
			<!-- First movie -->
<!--
			
			<div class="moviepanel noselect shadow"
				 data-title="TRAINWRECK"
				 data-genre="RC"
				 data-desc="Since she was a little girl, it's been drilled into Amy's head by her rascal of a dad that monogamy isn't realistic. Now a magazine writer, Amy lives by that credo-enjoying what she feels is an uninhibited life free from stifling, boring romantic commitment-but in actuality, she's kind of in a rut. <br><br>When she finds herself starting to fall for the subject of the new article she's writing, a charming and successful sports doctor named Aaron Conners , Amy starts to wonder if other grown-ups, including this guy who really seems to like her, might be on to something."
				 data-rating="MA"
				 data-times='	<p>Monday 9 PM</p>
								<p>Tuesday 9 PM</p>
								<p>Wednesday 1 PM</p>
								<p>Thursday 1 PM</p>
								<p>Friday 1 PM</p>
								<p>Saturday 6 PM</p>
								<p>Sunday 6 PM</p>'>
				<img src="posters/posterRC.jpg"/>

			</div>
-->

			<!-- Second movie -->
<!--
			<div class="moviepanel noselect shadow"
				 data-title="FANTASTIC FOUR"
				 data-genre="AC"
				 data-desc="A contemporary re-imagining of Marvel's original and longest-running superhero team, centers on four young outsiders who teleport to an alternate and dangerous universe, which alters their physical form in shocking ways. <br><br>Their lives irrevocably upended, the team must learn to harness their new abilities and work together to save Earth from a former friend turned enemy.Their lives irrevocably upended, the team must learn to harness their new abilities and work together to save Earth from a former friend turned enemy."
				 data-rating="M"
				 data-times='	<p>Wednesday 9 PM</p>
								<p>Thursday 9 PM</p>
								<p>Friday 9 PM</p>
								<p>Saturday 9 PM</p>
								<p>Sunday 9 PM</p>'>
				<img src="posters/posterAC.jpg"/>
			</div>
-->

			<!-- Third movie -->
<!--
			<div class="moviepanel noselect shadow"
				 data-title="INSIDE OUT"
				 data-genre="CH"
				 data-desc="Do you ever look at someone and wonder what is going on inside their head? Disney/Pixar’s original new film “Inside Out” ventures inside the mind to find out.<br><br>Based in Headquarters, the control center inside 11-year-old Riley’s mind, five Emotions are hard at work, led by lighthearted optimist Joy (voice of Amy Poehler), whose mission is to make sure Riley stays happy. Fear (voice of Bill Hader) heads up safety, Anger (voice of Lewis Black) ensures all is fair and Disgust (voice of Mindy Kaling) prevents Riley from getting poisoned-both physically and socially. Sadness (voice of Phyllis Smith) isn’t exactly sure what her role is, and frankly, neither is anyone else."
				 data-rating="PG"
				 data-times='	<p>Monday 1 PM</p>
								<p>Tuesday 1 PM</p>
								<p>Wednesday 6 PM</p>
								<p>Thursday 6 PM</p>
								<p>Friday 6 PM</p>
								<p>Saturday 12 PM</p>
								<p>Sunday 12 PM</p>'>
				<img src="posters/posterCH.jpg"/>
			</div>
-->

			<!-- Fourth movie -->
<!--
			<div class="moviepanel noselect shadow"
				 data-title="ASSASSINATION"
				 data-genre="AF"
				 data-desc="In 1933, in an era when the fatherland has fallen, the Provisional Government of the Republic of Korea singles out three people whose identities are unknown to Japan for a special mission. AHN Okyun, a sniper in the Korea Independence Army, Big Gun, a graduate of the Military School, and explosives expert Duk-sam!!"
				 data-rating="MA"
				 data-times='	<p>Monday 6 PM</p>
								<p>Tuesday 6 PM</p>
								<p>Saturday 3 PM</p>
								<p>Saturday 3 PM</p>'>
				<img src="posters/posterAF.jpg"/>
			</div>
-->
	</div>

		<?php include_once("includes/ticketdialog.php") ?>

		<?php include_once("includes/footer.php") ?>

	</body>
</html>
