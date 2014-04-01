<?php
	// TWITTER API
	require_once 'includes/codebird-php-master/src/codebird.php';

	$consumer_key = "eyo5toPrNcOn7LBVCohfyw";
	$consumer_secret = "8LqbwoFkOktrIffsMXAYBzhbYUMpV0VANrfxfOt58";
	$access_token = "59034638-Ei8J1Vb06rvSamIDdOuNPO7RF8LXxhzaaHz78xhJ6";
	$access_token_secret = "CFzJE0uKvAiu9MeUESD0dlunU2MhiDRtsFVxhHmKg7ZDN";

	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($access_token, $access_token_secret);
	
	$reply = $cb->oauth2_token();
	$bearer_token = $reply->access_token;
	
	// App authentication
	\Codebird\Codebird::setBearerToken($bearer_token);
?>

<?php
	// FLICKR API
	require_once 'includes/phpFlickr-3.1/phpFlickr.php';

	$user_id = "34864759@N05";
	$api_key = "a61f38056c82f968445bb729258172da";

	$f = new phpFlickr($api_key);
	$f->enableCache("db", "mysql://gilbertf:gilbertf@localhost/gilbertf");
?>