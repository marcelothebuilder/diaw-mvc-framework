<?php
namespace Vendor;

if (!ROOT_PATH){ die("Direct access to system files is denied."); }

class Config
{
	private static $contents = array();
	
	private function __construct() {}
	public static function get($group = 'app')
	{
		if (isset(self::$contents[$group]) && !empty(self::$contents))
			return (object)self::$contents[$group];
		throw new \Exception("Error retrieving config contents [$group].", 1);
	}

	public static function load($group = false)
	{
		if ($group === false)
			$group = 'app';

		$file = ROOT_PATH . SLASH . 'configs' . SLASH . $group . '.php';
		if (!file_exists($file))
			throw new \RuntimeException("File $file not there!");
		
		$config = array();

		require_once $file;

		self::$contents = array_merge(self::$contents, array($group => $config));

		unset($config);

	}
}

 ?>