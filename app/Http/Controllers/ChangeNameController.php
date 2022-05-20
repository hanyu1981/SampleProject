<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserProfile;

class ChangeNameController extends Controller
{
	public function Start(Request $request)
	{
		$client_master_version = $request->client_master_version;
		$user_id = $request->user_id;
		$user_name = $request->user_name;
		
		if($client_master_version < config('constants.MASTER_DATA_VERSION'))
		{
			//�G���[�ԋp
			return config('error.ERROR_MASTER_DATA_UPDATE');
		}
		
		//�����񒷂̃`�F�b�N
		if( 10 < strlen($user_name) )
		{
			//�G���[�ԋp
			$response = array('result' => 'Error', 'msg' => 'username is too long.');
			return json_encode($response);
		}
		
		//user_profile�e�[�u�����烌�R�[�h���擾
		$user_profile = UserProfile::where('user_id',$user_id)->first();
		
		if(!$user_profile)
		{
			//�G���[�ԋp
			$response = array('result' => 'Error', 'msg' => 'user profile is not found.');
			return json_encode($response);
		}
		
		$user_profile->user_name = $user_name;
		
		//db�ւ̏�������
		try
		{
			$user_profile->save();
		}
		catch(PDOException $e)
		{
			//�G���[�ԋp
			$response = array('result' => 'Error', 'msg' => 'db update failed.');
			return json_encode($response);
		}
		
		$response = array('result' => 'Success', 'user_profile' => $user_profile);
		return json_encode($response);
	}
}
