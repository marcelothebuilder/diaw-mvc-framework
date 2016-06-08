<?php if (!ROOT_PATH){ die("Direct access to system files is denied."); }
if (DEVELOPMENT)
	$benchmark_init = microtime();

set_exception_handler('exception');

function exception(Exception $e)
{
	// var_dump(func_get_args());
	echo 	"<pre>",
			"\nA wild exception appears:",
			$e->getMessage(),
			"\n StackTrace: ",
			$e->getTraceAsString(),
			"\n LastTrace: ",
			var_dump($e->getTrace()),
			"\n File: ",
			$e->getFile(),
			"\n Line: ",
			$e->getLine(),
			"\n Previous: ",
			$e->getPrevious(),
			"\n Code: ",
			$e->getCode(),
			"</pre>";
}

define ('SYS_PATH', dirname( __FILE__ ));

if (DEVELOPMENT)
{
	error_reporting(E_ALL|E_STRICT);
	ini_set('display_errors','On');
}
else
{
	error_reporting(E_ALL);
	ini_set('log_errors', 'On');
	ini_set('error_log', path(ROOT_PATH . SLASH .'tmp' . SLASH . 'error.log'));
}


ini_set('include_path', get_include_path() . PATH_SEPARATOR . SYS_PATH . SLASH );
ini_set('include_path', get_include_path() . PATH_SEPARATOR . APP_PATH . SLASH);
ini_set('include_path', get_include_path() . PATH_SEPARATOR . APP_PATH . SLASH . 'Extensions' . SLASH);
// ini_set('include_path', get_include_path() . PATH_SEPARATOR . APP_PATH . SLASH . 'ThirdParty' . SLASH);
// ini_set('include_path', get_include_path() . PATH_SEPARATOR . APP_PATH . SLASH . 'classes' . SLASH);
// ini_set('include_path', get_include_path() . PATH_SEPARATOR . APP_PATH . SLASH . 'models' . SLASH);
spl_autoload_extensions('.php');
spl_autoload_register();

function __autoload($name) {
    echo "Want to load $name.\n";
    // throw new MissingException("Unable to load $name.");
}

Vendor\Config::load();
$app = new Vendor\App();

if (DEVELOPMENT)
	$benchmark_end = microtime();

if (DEVELOPMENT)
	require 'devinfo.php';
