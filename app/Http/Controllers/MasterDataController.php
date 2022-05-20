<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterLoginItem;

class RegistrationController extends Controller
{
    public function Get(Request $request)
    {
    	//�N���C�A���g���ɑ��M�������f�[�^����
    	$master_login_item = MasterLoginItem::GetMasterLoginItem();
    	
    	$response = array(
    		'master_data_version' = config('constants.MASTER_DATA_VERSION'),
    		'master_login_item' = $master_login_item,
    	);
    	return json_encode($response);
    }
}
