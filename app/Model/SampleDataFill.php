<?php
namespace Model;
if (!ROOT_PATH) { die("Direct access to system files is denied."); }
use \Vendor\Model\DataFill;

class SampleDataFill extends \Vendor\Model\DataFill\BaseDataFill {
	public function expose() {
		$data["sample"] = "was_named_sample";
		return $data;
	}
}