<?php
get_header();
?>
	<div class="hero-inner">
		<span>Welcome to the</span>
		<h1>National Concert Venue</h1>
		<h2>New York City</h2>
	</div>

</div>

	<div class="blurb">
		<h2>Who We Are</h2>
		<p>The National Concert Venue in New York City doesn't exist. But if it did, it would be one of the largest and most exciting art venues in the world. Able to put on a range of events, such as concerts, plays, ballet and dance, it offers a chance for people of all ages and backgrounds to immerse themselves in the world of performing arts.</p>
		<p>The trustees of the National Concert Venue want to hear what customers like (or do not like) about the venue and it's shows. They hand out feedback cards, and include a link to this website's Boomerang page in confirmation emails. They are serious about improving.</p>
	</div>

<div class="feedback">
	<h2>We'd love to hear your thoughts about our venue</h2>
	<p>Tell us how we can improve by heading to our <a href="/feedback">feedback board</a>.</p>
</div>

<div class="shows">
	<div class="shows-inner">
		<h2>Matt Mullenweg</h2>
		<p><?php echo date('l jS \of F Y', strtotime("+47 days")); ?></p>
		<p>Doors open at 7pm</p>
	</div>
</div>

<?php
get_footer();