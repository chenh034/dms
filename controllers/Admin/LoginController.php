<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Admin;

/**
* 
*/
class LoginController extends Controller
{
	
	public function actionLogin(){
		Yii::$app->response->format = Response::FORMAT_JSON;

		$post = Yii::$app->request->post();
		
		$Admin = new Admin;
		$login_status = $Admin->login($post);

		if ($login_status['code']==0) {
			$user_id = Admin::find()->where(['username'=>$login_status['data']['username']])->one()->id;
			Yii::$app->session['admin'] = ['user_id'=>$user_id,'is_login'=>1];
			$login_status['data']['user_id'] = $user_id;
		}
		return $login_status;
		
	}

	
}