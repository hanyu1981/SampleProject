<?php
namespace App\Libs;
use App\MasterLoginItem;

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
	
	public static function GetMasterData($data_name)
	{
		$file = fopen(__DIR__ . '/' . config('constants.MASTER_DATA_VERSION'),'r');
		if( !$file )
		{
			return false;
		}
		$json = array();
		while($line = fgets($file))
		{
			$json = json_decode($line,true);
		}
		if(!array_key_exists($data_name,$json))
		{
			return false;
		}
		return $json[$data_name];
	}
	public static function CheckMasterDataVersion($client_master_version)
	{
		return config('constants.MASTER_DATA_VERSION') <= $client_master_version;
	}
	public static function GetMasterDataSize()
	{
		$size = filesize(__DIR__ . '/' . config('constants.MASTER_DATA_VERSION'));
		$size_bytes = floatval($size);
		return $size_bytes;
	}
}
