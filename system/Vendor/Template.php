<?php
namespace Vendor;
if (!ROOT_PATH){ die("Direct access to system files is denied."); }

/**
 * Template class.
 * Needs a major refactoring, made with alcohol and love.
 */
class Template extends View
{
	protected $_suffix = '.tpl.php';
	protected $_objects = array();
	protected $_templateReplaces = array(
		'/\<\?php(?:.*?\n?)+(?:\?\>)/' => '<!--php code removed from template-->',
		'/\<\!--\s*((?:else ?)?if|while)\s*([^\>]+)-->/' => '<?php $1($2): ?>',
		'/\<\!--\s*\/(if|foreach|while)\s*--\>/' => '<?php end$1; ?>',
		'/\<\!--\s*else\s*--\>/' => '<?php else: ?>',
		'/\[\[(=?[a-zA-Z_\x7f-\xff][:\.\-a-zA-Z0-9_\x7f-\xff]*)\]\]/' => array('<?php echo \$$1 ?>', 'var'),
		'/\<\!\-\-(?:.*?\n?)+(?:\-\-\>)/' => '',

		'/(?:\s?\r?\n\s?)+/' => '', //compress html
		
		// '/\>\s+/' => '>', // compress
		// '/\s+\</' => '<', // compress
		// '/\r?\n/' => '', // compress
	);

	protected function _renderingMethod(&$path, &$renderData)
	{
		extract($renderData);
		$content = file_get_contents($path);
		
		$content = $content . "<?php ";
		$templateModifiedTime = filemtime($path);
		// $path = preg_replace("/($this->_suffix)/", ".compiled$1", $path);
		$fname = basename($path);
		// if (!file_exists(PATH . SLASH . 'cache'))
		// 	mkdir(PATH . SLASH . 'cache');
		if (!file_exists(ROOT_PATH . SLASH . 'tmp' . SLASH . 'template' . SLASH))
			mkdir(ROOT_PATH . SLASH . 'tmp' . SLASH . 'template' . SLASH, 0777, true);
		// echo( ROOT_PATH . SLASH . 'tmp' . SLASH . 'template' . SLASH . 'phpcode.' . $fname); 
		// die();
		// 
		$path = ROOT_PATH . SLASH . 'tmp' . SLASH . 'template' . SLASH . 'phpcode.' . $fname;
		$compiledModifiedTime = file_exists($path) ? filemtime($path) : 0;

		if (DEVELOPMENT || $templateModifiedTime > $compiledModifiedTime)
		{
			foreach ($this->_templateReplaces as $pattern => $replacement) {
				if (is_array($replacement))
				{
					$content = preg_replace_callback($pattern,
						
						function (&$match)
						{

							$echo = '';
							$echo_end = '';
							if (substr($match[1], 0, 1) === '=')
							{
								$match[1] = substr($match[1], 1, strlen($match[1]));
								$echo = '<?php echo ';
								$echo_end = ' ?>';
							}
							$match[1] = preg_replace_callback('/::([^:-]+)(?:\-([^:]+))?/',
								function($matchNestedd)
								{

									if(!is_int($matchNestedd[2]))
										$matchNestedd[2] = '\'' . $matchNestedd[2] . '\'';

									return '->' . $matchNestedd[1] . '(' . $matchNestedd[2] . ')'; // unquoted int
								}
							, $match[1]);
								
							$match[1] = preg_replace('/:([^:]+)/', '->$1', $match[1]);
							$match[1] = preg_replace_callback('/\.([^\[\]]+)/',
								function(&$nestedMatch)
								{
									if(!is_int($nestedMatch[1]))
										$nestedMatch[1] = '\'' . $nestedMatch[1] . '\'';
									
									return '[' . $nestedMatch[1] . ']'; // unquoted int
								},
								$match[1]);
							return $echo  . '$' . $match[1] . $echo_end;
						},
						
						$content);
				}
				else
				{
					$content = preg_replace($pattern, $replacement, $content);
				}
			}
			$h = fopen($path, 'w');
			fwrite($h, $content);
			fclose($h);
		}

		require_once $path;
	}

	public function assign($key, $value)
	{
		if (is_object($value) &&
				array_search('TemplateFriendlyInterface',
					class_implements(get_class($value), false), true
				)
			)
		{
			// free!
			$this->_objects[] =& $value;
		} else {
			parent::assign($key, $value);
		}
		
	}
}