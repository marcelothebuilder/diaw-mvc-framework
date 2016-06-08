<?php
namespace Vendor;

if (!ROOT_PATH){ die("Direct access to system files is denied."); }

use Vendor\Utils\Vars;
class Loader
{
	public static function loadController($controller, $action, $parameters)
	{
		$name = Config::get()->controllersNamespace . strip_tags(ucfirst($controller) . 'Controller');

		// skip directly to autoloading
		$controllerObject = new $name(new Loader());

		if (!Vars::scalar_value($action))
			$action = 'index';
		
		try {
			$testAccess = new \ReflectionMethod($name, $action);
		} catch (ReflectionException $e)
		{
			throw new LoaderControllerException(
				'Method ' . $action . ' not found in class ' . $name . ', file ' . $path,
				LoaderControllerException::CODE_METHOD
			);
		}

		if (!$testAccess->isPublic())
			throw new LoaderControllerException(
				'Method ' . $action . ' not found in class ' . $name . ', file ' . $path,
				LoaderControllerException::CODE_METHOD
			);

		$controllerObject->$action($parameters);

		return $controllerObject;
	}


	public function external($path)
	{
		require_once($path);
	}
}

class LoaderControllerException extends \RuntimeException {
	const CODE_UNKNOWN			  = 0;
	const CODE_FILE				  = 1;
	const CODE_CLASS			  = 2;
	const CODE_METHOD			  = 3;
	const CODE_METHOD_UNACESSIBLE = 4;
}