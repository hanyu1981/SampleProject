<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterLoginItem;
use App\Libs\MasterDataService.php;

class MasterDataController extends Controller
{
    public function Get(Request $request)
    {
    	//クライアント側に送信したいデータだけ
    	$master_login_item = MasterLoginItem::GetMasterLoginItem();
    	
    	$response = array(
    		'result' => 'Success',
    		'error_code' => 0,
    		'master_data_version' => config('constants.MASTER_DATA_VERSION'),
    		'master_login_item' => $master_login_item,
    	);
    	return json_encode($response);
    }
	
	public function GetSize(Request $request)
	{
		$size_bytes = MasterLoginItem::GetMasterDataSize();
		$response = array('size_bytes' => $size_bytes);
		return $size_bytes;
	}
}
