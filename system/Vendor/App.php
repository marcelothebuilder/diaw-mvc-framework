<?php
namespace Vendor;

if (!ROOT_PATH){ die("Direct access to system files is denied."); }

use Vendor\Utils\Vars;

class App
{
	/**
	 * recebe da URL o valor do controlador
	 * @var string
	 */
	protected $_controller = null;
	/**
	 * recebe da URL o valor da açao
	 * @var string
	 */
	protected $_action = null;
	/**
	 * recebe da URL os parametros, como se fosse o antigo GET
	 * @var array
	 */
	protected $_parameters = null;

	public $controller;

	function __construct()
	{
		if (!Vars::array_value($_GET, 'app'))
		{
			$this->_controller =& Config::get()->defaultController;
		} else {
			// recebemos uma querystring!
			$queryStringArray = explode('/', $_GET['app']);
			$this->_controller	= array_shift($queryStringArray);
			$this->_action		= array_shift($queryStringArray);
			$this->_parameters	=& $queryStringArray;
		}

		try {
			$this->controller = Loader::loadController($this->_controller, $this->_action, $this->_parameters);
		} catch (LoaderControllerException $e) {
			if (DEVELOPMENT)
				echo ($e->getMessage());
			else
				die ('404 :(');
		}
	}
}

 ?>