<?php 

namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\FontUser;

/**
* 
*/
class LoginController extends Controller
{
	
	public function actionLogin(){

		$post = Yii::$app->request->post();
		
		$FontUser = new FontUser;
		$login_status = $FontUser->login($post);

		if ($login_status['code']==0) {
			// $user_id = FontUser::find()->where(['username'=>$login_status['data']['username']])->one()->id;
			$user_id = $login_status['data']['user_id'];
			Yii::$app->session['font'] = ['user_id'=>$user_id,'is_login'=>1];
			$login_status['data']['user_id'] = $user_id;
		}

		print_r($login_status);
		
	}

	public function actionTest(){
         echo Yii::$app->session['font']['user_id'];
	}
}