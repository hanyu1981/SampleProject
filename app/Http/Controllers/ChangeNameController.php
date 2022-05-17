<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserProfile;

class ChangeNameController extends Controller
{
	public function Start(Request $request)
	{
		$user_id = $request->user_id;
		$user_name = $request->user_name;

		
		//文字列長のチェック
		if( 10 < strlen($user_name) )
		{
			//エラー返却
			$response = array('result' => 'Error', 'msg' => 'username is too long.');
			return json_encode($response);
		}
		
		//user_profileテーブルからレコードを取得
		$user_profile = UserProfile::where('user_id',$user_id)->first();
		
		if(!$user_profile)
		{
			//エラー返却
			$response = array('result' => 'Error', 'msg' => 'user profile is not found.');
			return json_encode($response);
		}
		
		$user_profile->user_name = $user_name;
		
		//dbへの書き込み
		try
		{
			$user_profile->save();
		}
		catch(PDOException $e)
		{
			//エラー返却
			$response = array('result' => 'Error', 'msg' => 'db update failed.');
			return json_encode($response);
		}
		
		$response = array('result' => 'Success', 'userprofile' => $user_profile);
		return json_encode($response);
	}
}
