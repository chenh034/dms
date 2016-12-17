<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FarmUser;

/**
* 
*/
class IndexController extends Controller
{
	
	public function actionContact(){
		// $user_id = Yii::$app->session['farm_user'];
		$user_id = 1;
		$FarmUser = FarmUser::findOne($user_id);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$edit_status = $FarmUser->editUser($post,'contact');
			if ($edit_status['code'] == 0) {
				echo '修改成功';
			}else{
				echo '修改失败';
			}

		}
	}

	public function actionFarm(){
		// $user_id = Yii::$app->session['farm_user'];
		$user_id = 1;
		$FarmUser = FarmUser::findOne($user_id);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$edit_status = $FarmUser->editUser($post,'farm');
			if ($edit_status['code'] == 0) {
				echo '修改成功';
			}else{
				echo '修改失败';
			}

		}
	}

	public function actionAccount(){
		// $user_id = Yii::$app->session['farm_user'];
		

	}
}