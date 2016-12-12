<?php

namespace app\controllers\farm;

use Yii;
use yii\web\Controllers;
use app\models\FarmUser;

/**
* 
*/
class LoginController extends Controller
{
	
	public function actionLogin(){
		Yii::$app->response->format = Response::FORMAT_JSON;

		$post = Yii::$app->request->post();
		
		$FarmUser = new FarmUser;
		$login_status = $FarmUser->login($post);

		if ($login_status['code']==0) {
			$user_id = FarmUser::find()->where(['username'=>$login_status['data']['username']])->one()->id;
			Yii::$app->session['farm_user'] = ['user_id'=>$user_id,'is_login'=>1];
			$login_status['data']['user_id'] = $user_id;
		}
		return $login_status;
		
	}
}