<?php 
namespace Controller;
if (!ROOT_PATH) { die("Direct access to system files is denied."); }
use \Vendor\View;
use \Vendor\Template;

class HomeController extends \Vendor\Controller
{
	public function index()	{
		$template = new Template();
		$df = new \Model\SampleDataFill();
		$template->dataFiller($df);
		$template->assign('username', 'Maria');
		$template->render('sample');
	}
}