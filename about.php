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
		<p>
			"About" page: you are asked to include the "about" page that will describe the purpose of the system and its main functionality.

			It is difficult, despite the era of extreme connectivity, to find people from around the world who are thinking the same ideas as you. Great Minds Co. wants to help make finding this connection easier for everyone, so they can make their ideas happen, with people who are equally passionate about your dreams.

			The concept of the site will be about the promotion and sharing of ideas, and the idea that "great minds think alike".
			-- Idea-Makers are... Promoters are...
			-- To differentiate between Idea-Makers and Promoters: Idea-Makers are different in that they are groups of people, or even organizations that work on Projects.
			
			-- Promoters can post Ideas (essentially a post) and promote Ideas.
			-- When two Idea posts between two Promoters are similar (via tags, perhaps), Promoters get the option to send a connect request.
			-- Once they are both connected, they become Idea-Makers, and their original Idea posts will become a Project.
			-- Idea-Makers will have the ability to further develop their Projects together.

			On this site, everyone should be able to search and filter through others’ ideas, follow them, promote them, and post an idea of their own. But in order to make the connection of ideas happen, and to start the relationships between like-minded people, the system will suggest connections between members through tags listed on the idea. Once the connection is made, Promoters will become Idea-Makers. The idea will now become the thing of focus, and become a Project for these members to work on.
		</p>
	</div>
	<div class="bar flex">
		<h3>About the Author</h3>
		<p>
			"Author/Creator": short paragraph on yourself.

			I'm Gilbert Fung and I made this website. I am a designer with much to learn, studying in the School of Interactive Arts and Technology at Simon Fraser University. 
			Right now I'm developing my web design skills, but I am proficient at 3D modeling and graphic design as well.
			I have many ideas swirling around in my head, but taking action on these ideas is what matters. This is one of those ideas that I've done something about.
		</p>
	</div>
	<div class="bar flex">
		<h3>Technical Details</h3>
		<p>
			"Technical details" page: this can be linked from the about page, included in the details page, standing as a menu on its own. Consider this to be a quick summary of your technical capabilities that anyone can then see in action. Treat it as a part of your CV.

			This site demonstrates various skills I have learned while creating this website.
			-- Setting up XAMPP / Apache
			-- Using PHP
			-- Working with Databases
			-- Authentication
			-- Using APIs
			-- AJAX and XML


			Excellent project. I noticed only few minor issues. 

				The first one is related to the assignment requirements, where you did not provide an option for users to select whether they want to see tweets and/or flickr photos. That is, on a profile page, you should just enable user to hide/display tweets and photos. 

				You should provide more details in the report (just extend A2 report). Although all functions are implemented correctly, file function.php handles too many responsibilities. Please consider splitting functions in separate files, according to functionalities they address. 
		</p>
	</div>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>