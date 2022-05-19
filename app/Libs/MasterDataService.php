<?php
namespace App/Libs;
use App/MasterLoginItem;

class MasterDataService
{
	public static function GenerateMasterData($version)
	{
		touch(__DIR__ . '/' . $version);
		chmod(__DIR__ . '/' . $version, 0666);
		
		$master_data_list = array();
		$master_data_list['master_login_item'] = MasterLoginItem::all();
		
		$json = json_encode($master_data_list);
		file_put_contents(__DIR__ . '/' . $version, $json);
	}
}
