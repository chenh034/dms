<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Handbook;
use crazyfd\qiniu\Qiniu;

/**
* 
*/
class A_articleController extends Controller
{
	
	public function actionAdd(){
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$post['update_time'] = time();

			if (isset($_FILES['cover'])) {
				$post['img_url'] = $this->uploadPic();
			}

			$Handbook = new Handbook;
			$add_status = $Handbook->addArticle($post);

			if ($add_status['code']==0) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}

		}
	}

	public function actionEdit($id){
		$id = (int)$id;
		$Handbook = Handbook::findOne($id);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$post['update_time'] = time();

			if (isset($_FILES['cover'])) {
				$this->delPic($Handbook->img_url);
				$post['img_url'] = $this->uploadPic();
			}else{
				$post['img_url'] = $Handbook->img_url;
			}

			$edit_status = $Handbook->editArticle($post);

			if ($edit_status['code']==0) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
			return;

		}
		print_r(json_encode($Handbook->attributes));
	}

	public function actionDel($id){
		$id = (int)$id;
		$Handbook = Handbook::findOne($id);
		if (!is_null($Handbook)) {
			if ($Handbook->delete()) {
				echo '{"code":0}';
			}else{
				echo '{"code":1}';
			}
		}else{
			echo '{"code":0}';
		}
	}


	private function uploadPic(){
		if ($_FILES['cover']['error'] > 0) {
			return false;
		}
		$qiniu = new Qiniu(Handbook::AK, Handbook::SK, Handbook::DOMAIN, Handbook::BUCKET);
		$key = uniqid();
        $qiniu->uploadFile($_FILES['cover']['tmp_name'], $key);
        $img_url = $qiniu->getLink($key);

        return $img_url;
	}

	private function delPic($link){
		$qiniu = new Qiniu(Handbook::AK, Handbook::SK, Handbook::DOMAIN, Handbook::BUCKET);
        $qiniu->delete(basename($link));
	}

}