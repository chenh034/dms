<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Question;
use app\models\QuestionType;

/**
* 
*/
class A_questionController extends Controller
{  	
	public function actionAddtype(){
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$Type = new QuestionType;
			$Type->name = $post['name'];
			if ($Type->save()) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}
	}

	public function actionEdittype($id){
		$id = (int)$id;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$Type = QuestionType::findOne($id);
			$Type->name = $post['name'];
			if ($Type->save()) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}
	}

	public function actionDeltype($id){
		$id = (int)$id;
		$Type = QuestionType::findOne($id);
		if (!is_null($Type)) {
			if ($Type->delete()) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}else{
			echo '{"code":0}';
		}

	}

	public function actionAdd(){
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$Question = new Question;
			$add_status = $Question->addQuestion($post);

			if ($add_status['code']==0) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}
	}

	public function actionEdit($id){
		$id = (int)$id;
		$Question = Question::findOne($id);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$edit_status = $Question->editQuestion($post);

			if ($edit_status['code']==0) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
			return;
		}else{
			print_r(json_encode($Question->attributes));
		}

	}

	public function actionDel($id){
		$id = (int)$id;
		$Question = Question::findOne($id);
		if (!is_null($Question)) {
			if ($Question->delete()) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}else{
			echo '{"code":0}';
		}
	}
}