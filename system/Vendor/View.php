<?php
namespace Vendor;
use \Vendor\Model\DataFill\BaseDataFill;
use \Vendor\Utils\Typecheck;

if (!ROOT_PATH){ die("Direct access to system files is denied."); }

class View
{
	protected $_suffix 		= '.php';	// string
	protected $_vars 		= array();	// array of mixed
	protected $_dataFills 	= array();  // array of Model\DataFill

	public function dataFiller(BaseDataFill &$df)
	{
		Typecheck::notNull($df);
		$this->_dataFills[] = $df;
	}

	public function render($path)
	{
		$this->_renderCheckPath($path);
		$renderData = $this->_renderGetData();
		Typecheck::isAssocArray($renderData);
		$this->_renderingMethod($path, $renderData);
	}

	public function assign($key, $value)
	{
		Typecheck::isScalar($key);
		$this->_vars[$key] = &$value;
	}

	protected function _renderCheckPath(&$path)
	{
		// echo $this->_suffix;
		Typecheck::isString($path);
		$path = APP_PATH . SLASH . 'View' . SLASH . $path . $this->_suffix;
		if (!is_readable($path))
			die ("TEMPLATE ERROR " . $path . "\n");
	}

	protected function _renderGetData()
	{
		$this->_addDataFills();
		return $this->_vars;
	}

	protected function _addDataFills()
	{
		foreach ($this->_dataFills as $dataFill) {
			$this->_vars = array_merge($this->_vars, $dataFill->expose());
		}
	}

	protected function _renderingMethod(&$path, &$renderData)
	{
		extract($renderData);
		require_once $path;
	}
}