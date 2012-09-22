<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Kohana wrapper for the working with the Tumblr API
 *
 * @package	Kerkness
 * @category   Tumblr
 * @author	 Ryan Mayberry
 * @copyright  (c) 2009-2012 Mayberry Holdings Ltd
 */
class Kohana_tumblr
{
	public $attributes = array();
	public $method;
	public $action;
	public $config;
	public $response;


	public static function factory($method='posts', $action=NULL)
	{
		return new Kohana_tumblr($method, $action);
	}

	public function __construct($method="posts", $action=NULL)
	{
		$this->method = $method;
		$this->action = $action;
		$this->config = Kohana::$config->load('tumblr');
	}
	
	public function attributes($values=array())
	{
		foreach($values as $name=>$value)
		{
			$this->attribute($name, $value);
		}
		
		return $this;
	}
	
	public function attribute($name, $value)
	{
		$this->attributes[$name] = $value;
		
		return $this;
	}
	
	public function api_url()
	{
		$url =  'http://'.$this->config['api_url'].'/'.$this->config['host_name'];
		$url .= '/'.$this->method;
		
		if( $this->action )
		{
			$url .= '/'.$this->action;
		}
		
		if( ! array_key_exists('api_key', $this->attributes))
		{
			$this->attribute('api_key', $this->config['api_key']);
		}
		
		
		$url .= Url::query($this->attributes, false);
		
		return $url;
	}
	
	public function execute()
	{
		$this->response = Request::factory($this->api_url())->execute()->body();
		
		return $this;
	}
	
	public function response()
	{
		return $this->response;
	}
}