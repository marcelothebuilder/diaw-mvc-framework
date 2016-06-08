<?php 
namespace Libraries;
/**
* Exterals
*/
class PHPMailerFactory
{
	private function __construct() {}

	public static function getInstance()
	{
		$loader = new \Vendor\Loader();
		$loader->external('ThirdParty/PHPMailer/PHPMailerAutoload.php');
		$mailer = new \PHPMailer();
		return $mailer;
	}
}