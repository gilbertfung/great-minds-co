<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/apiconfig.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?>
<?php require 'includes/layouts/header.php'; ?>
<div id="cover">
	<h2>About Great Minds Co.</h2>
	<div class="bar flex">
		<h3>About Great Minds</h3>
		<p>It is difficult, despite the era of extreme connectivity, to find people from around the world who are thinking the same ideas as you. Great Minds Co. wants to help make finding this connection easier for everyone, so they can make their ideas happen, with people who are equally passionate about your dreams.</p>
		<p>The concept of the site is about the promotion and sharing of ideas, and the idea that "great minds think alike".</p>
		<dl>
			<dt>As a Promoter, you can:</dt>
			<dd><ul>
				<li>Promote other people's Ideas</li>
				<li>Post your own Ideas</li>
				<!-- <li>Find other people with the same Ideas as you, and connect with them</li> -->
			</ul></dd>
			<dt>As an Idea-Maker:</dt>
			<dd><ul>
				<li>Do all of the above</li>
				<li>Make Projects, which are like Ideas, but have the ability to post Project Updates which allow for more development of your Project.</li>
				<!-- <li>Make your Project with the partners you've connected</li> -->
			</ul></dd>
		</dl>
	</div>
	<div class="bar flex">
		<h3>About the Author</h3>
		<p>I'm Gilbert Fung and I made this website. I am a designer with much to learn, studying in the School of Interactive Arts and Technology at Simon Fraser University. Right now I'm developing my web design skills, but I am proficient at 3D modeling and graphic design as well. I have many ideas swirling around in my head, but taking action on these ideas is what matters. This is one of those ideas that I've done something about (still a work in progress, of course).</p>
	</div>
	<div class="bar flex">
		<h3>Technical Details</h3>
		<p>This site demonstrates various skills I have learned while creating this website:</p>
		<ul>
			<li>Setting up XAMPP / Apache - Basic configuration of Apache</li>
			<li>Using PHP - Making a website with dynamic content, and user management</li>
			<li>Working with Databases - Designing a database with possible expansion, working with SQL queries</li>
			<li>Authentication - Using HTTPS and securely store passwords</li>
			<li>Using APIs - Access Flickr and Twitter account activity using their APIs (XML and JSON), and using API libraries (phpFlickr and Codebird in this case)</li>
			<li>AJAX and XML - Dynamically update content without user reloading. Generate and parse XML for AJAX requests and responses.</li>
		</ul>
	</div>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>