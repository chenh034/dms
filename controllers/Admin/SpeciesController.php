<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Species;
use yii\web\Response;
use crazyfd\qiniu\Qiniu;

/**
* 
*/
class SpeciesController extends Controller
{
	

	public function actionToAdd(){
        $SpeciesType = Species::find()->select(['id','name'])->where(['parent_id'=>0])->asArray()->all();
        // print_r($SpeciesType);
	}


	public function actionAdd(){
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$img_url = $this->uploadPic();
			$post['img_url'] = $img_url;


			$Species = new Species;
			$add_status = $Species->addSpecies($post);

			if ($add_status['code'] ==0) {
				echo '添加成功';
			}else{
				echo '添加失败';
			}
		}
	}


	public function actionEdit($id){
        $Species = Species::findOne($id);
        if (Yii::$app->request->isPost) {
        	$post = Yii::$app->request->post();

        	$post['img_url'] = $Species->img_url;
        	if ($_FILES['cover']['error']==0) {
				$img_url = $this->uploadPic();
				$post['img_url'] = $img_url;
				if ($Species->img_url) {
					$this->delPic($Species->img_url);
				}
			}

        	$edit_status = $Species->editSpecies($post);
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
		$Species = Species::findOne($id);
		if (!is_null($Species)) {
			$this->delPic($Species->img_url);
			if ($Species->delete()) {
				echo "删除成功";
			}else{
				echo '删除失败';
			}
		}
	}

	public function actionJson($page){
		Yii::$app->response->format = Response::FORMAT_JSON;
        // $offset = $page*10-1;
        $data = Species::find()->select(['name','special','parent_id','img_url'])->orderBy('id desc')->all();
        return $data;
	}


	private function uploadPic(){
		if ($_FILES['cover']['error'] > 0) {
			return false;
		}
		$qiniu = new Qiniu(Species::AK, Species::SK, Species::DOMAIN, Species::BUCKET);
		$key = uniqid();
        $qiniu->uploadFile($_FILES['cover']['tmp_name'], $key);
        $img_url = $qiniu->getLink($key);

        return $img_url;
	}

	private function delPic($link){
		$qiniu = new Qiniu(Species::AK, Species::SK, Species::DOMAIN, Species::BUCKET);
        $qiniu->delete(basename($link));
	}

}
