<?php 
namespace Vendor\Utils;
// throw new \Exception("Deprecated");

class Vars
{
	private function __construct() {}

	/**
	 * checa se a key está definida na array informada antes de retornar um valor.
	 * @method value
	 * @param  array      &$array onde vamos buscar a chave
	 * @param  mixed      $key   chave em que vamos buscar o valor
	 * @return mixed|null              o valor da chave se existir, nulo se não existir
	 */
	public static function array_value(&$array, $key) {
		if (isset($array[$key]) && !empty($array[$key])) {
			return $array[$key];
		}
		return null;
	}

	public static function scalar_value(&$scalar) {
		if (isset($scalar) && !empty($scalar)) {
			return $scalar;
		}
		return null;
	}

	public static function insideArray($mixed)
	{
		try
		{
			Typecheck::isArray($mixed);
		}
		catch (TypecheckInvalidTypeException $e)
		{
			return array($mixed);
		}

		// is an array
		return $mixed;
	}

}

