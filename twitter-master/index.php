<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' =>"757620776396730368-mNSrd9M7WZJzaAxoyEXOoVPHsSSo0sX",
    'oauth_access_token_secret'=>"colKXBFEfjmlPiOvjf4TLWa64BSpoo6qModQKB6X00xpr",
    'consumer_key' => "W06hUgFCV7qwfJdO1eclpF2nL",
    'consumer_secret' => "DUtH77FN1QOAHxyQcX5rYq0UeolCRMHb2PAmWmKAo4ikUPXwd1"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);

// /** Perform a POST request and echo the response **/
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#policebrutality&count=10';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweetData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc=TRUE);
foreach($tweetData['statuses'] as $index => $items){
      $userArray = $items['user'];
      echo '<div class="twitter-tweet"> <a href="http://twitter.com/' . $userArray['screen_name'] . '"><img src="' . $userArray['profile_image_url'] . '"></a><a href="http://twitter.com/' . $userArray['screen_name'] . '">' . $userArray['name'] . '</a><br/>' . $items['text'];
      echo '<br/>' . $items['created_at'];
      echo '</div>';
};
