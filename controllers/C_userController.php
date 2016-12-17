<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admin;
use app\models\FontUser;
use app\models\ReceiptAddress;

/**
* 
*/
class C_userController extends Controller
{
	
	public function actionIndex(){
		echo 1111;
	}

	public function actionTest(){
		echo 2222;
	}

	public function actionUser($id){
		if (Yii::$app->request->isPost) {
			$FontUser = FontUser::findOne($id);
			$post = Yii::$app->request->post();
			$FontUser->nickname = $post['nickname'];
			$FontUser->scenario = "edit";
			if ($FontUser->save()) {
				echo '修改成功';
			}else{
				echo '修改失败';
			}
		}
	}

	public function actionAddress(){
		// $user_id = Yii::$app->session['font']['user_id'];
		$user_id = 1;
		if (Yii::$app->request->isPost) {
			$ReceiptAddress = new ReceiptAddress;

			$post = Yii::$app->request->post();
			$post['user_id'] = $user_id;
			$add_status = $ReceiptAddress->addAddress($post);
			if ($add_status['code']==0) {
				echo '添加成功';
			}else{
				echo '添加失败';
			}
		}
	}

	public function actionEdit($id){
		$id = (int)$id;
		$ReceiptAddress = ReceiptAddress::findOne($id);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$edit_status = $ReceiptAddress->editAddress($post);
			if ($edit_status['code']==0) {
				echo '修改成功';
			}else{
                echo '修改失败';
			}
		}
	}

	public function actionDel($id){
        $id = (int)$id;

        $ReceiptAddress = ReceiptAddress::findOne($id);
        if (!is_null($ReceiptAddress)) {
        	if ($ReceiptAddress->delete()) {
	        	echo '删除成功';
	        }else{
	        	echo '删除失败';
	        }
        }
	}

	public function actionDefault($id){
		$id = (int)$id;

		$status = ReceiptAddress::findOne($id)->changeDefault();
        
        if ($status['code']==0) {
        	echo '修改成功';
        }else{
        	echo '修改失败';
        }
	}
}