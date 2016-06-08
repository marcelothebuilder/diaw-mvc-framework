<?php
namespace Vendor;

if (!ROOT_PATH){ die("Direct access to system files is denied."); }

abstract class Controller
{
	protected $loader;

	/**
	 * inicia o loader e define parametros
	 * @method __construct
	 * @param  array       $parameters ?
	 */
	function __construct($loader)
	{
		$this->loader = $loader;
	}

	abstract function index();	
}

 ?>