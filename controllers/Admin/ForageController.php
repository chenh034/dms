<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Forage;
use app\models\ForageType;
use yii\web\Response;
use crazyfd\qiniu\Qiniu;

/**
* 
*/
class ForageController extends Controller
{
	
	public function actionAdd(){
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$img_url = $this->uploadPic();
			$post['img_url'] = $img_url;

			$ForageType = new ForageType;
			$add_status = $ForageType->addForage($post);

			if ($add_status['code'] ==0) {
				echo '添加成功';
			}else{
				echo '添加失败';
			}
		}
	}

	public function actionEdit($id){
		$ForageType = ForageType::findOne($id);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$post['img_url'] = $ForageType->img_url;
        	if ($_FILES['cover']['error']==0) {
				$img_url = $this->uploadPic();
				$post['img_url'] = $img_url;
				if ($ForageType->img_url) {
					$this->delPic($ForageType->img_url);
				}
			}

			$edit_status = $ForageType->editForage($post);

			if ($edit_status['code']==0) {
        		echo '修改成功';
        	}else{
        		echo '修改失败';
        	}
        	return;
		}
	}

	public function actionDel($id){
		$id = (int)$id;
		$ForageType = ForageType::findOne($id);
		if (!is_null($ForageType)) {
			$this->delPic($ForageType->img_url);
			if ($ForageType->delete()) {
				echo "删除成功";
			}else{
				echo '删除失败';
			}
		}
	}

	public function actionJson($page){
		Yii::$app->response->format = Response::FORMAT_JSON;
        // $offset = $page*10-1;
        $data = ForageType::find()->select(['name','object','ingredient',])->orderBy('id desc')->all();
        return $data;
	}


	private function uploadPic(){
		if ($_FILES['cover']['error'] > 0) {
			return false;
		}
		$qiniu = new Qiniu(ForageType::AK, ForageType::SK, ForageType::DOMAIN, ForageType::BUCKET);
		$key = uniqid();
        $qiniu->uploadFile($_FILES['cover']['tmp_name'], $key);
        $img_url = $qiniu->getLink($key);

        return $img_url;
	}

	private function delPic($link){
		$qiniu = new Qiniu(ForageType::AK, ForageType::SK, ForageType::DOMAIN, ForageType::BUCKET);
        $qiniu->delete(basename($link));
	}

}