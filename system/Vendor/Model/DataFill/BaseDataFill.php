<?php
namespace Vendor\Model\DataFill;

abstract class BaseDataFill
{
	/**
	 * this MUST expose all the DataFill vars through an associative array
	 * example: if this method returns $this->_data, that contains
	 * $this->_data['phrase'] = 'Happy Birthday'
	 * the View will receive it as $phrase.
	 * Just make sure it returns an assoc array, else it won't work.
	 * 
	 * @method expose
	 * @return [type] [description]
	 */
	abstract function expose();
}