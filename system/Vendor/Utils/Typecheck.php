<?php 
namespace Vendor\Utils;
// throw new \Exception("vsf");
// new Typecheck();
class Typecheck
{

	public static function isInteger(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_int($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be an integer");
		return $parameter;
	}

	public static function isString(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_string($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be a string");
		return $parameter;
	}	

	public static function isAssocArray(&$parameter, $notNull = true)
	{
		self::isArray($parameter);
		$keys = array_keys($parameter);
		if (!is_string($keys[0]))
			throw new TypecheckInvalidTypeException("Parameter must be an associative array");
		return $parameter;
	}

	public static function isArray(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_array($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be an array");
		return $parameter;
	}

	public static function isFloat(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_float($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be a float");
		return $parameter;
	}

	public static function isScalar(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_scalar($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be a scalar");
		return $parameter;
	}

	public static function isObject(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_object($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be an object");
		return $parameter;
	}

	public static function isBool(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_bool($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be a boolean");
		return $parameter;
	}

	public static function isResource(&$parameter, $notNull = true)
	{
		if ($notNull)
			self::notNull($parameter);
		if (!is_resource($parameter))
			throw new TypecheckInvalidTypeException("Parameter must be a resource");
		return $parameter;
	}

	public static function notNull(&$parameter)
	{
		switch (true){
			case !isset($parameter):
				throw new TypecheckUnsetException("Parameter can't be null");	
				break;
			case is_null($parameter):
				throw new TypecheckNullException("Parameter can't be null");
				break;
			case empty($parameter):
				throw new TypecheckEmptyException("Parameter can't be null");
				break;
		}

		return $parameter;
		// return $parameter;
	}		
}


class TypecheckInvalidTypeException extends \InvalidArgumentException {}
class TypecheckGenericNullException	extends \InvalidArgumentException {}
class TypecheckNullException		extends TypecheckGenericNullException {}
class TypecheckEmptyException		extends TypecheckGenericNullException {}
class TypecheckUnsetException		extends TypecheckGenericNullException {}