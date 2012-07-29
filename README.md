*A Basic Tumblr Module for Kohana 3.x Applications*

For compete documentation on the Tumblr API see  http://tumblr.com/api

Set Up

- Register an api key for the tumblr api (http://tumblr.com/api)
- Include this module in your Kohana application. (3.2+ suggested)
- Edit config/tumblr.php to use your tumblr hostname and api_key

Examples

	$posts_json = Tumblr::factory()->execute()->response();
	
	$photos_json = Tumblr::factory('posts', 'photo')->execute()->response();
	
	$blog_info = Tumblr::factory('info')->execute()->response();