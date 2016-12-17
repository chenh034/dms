<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;

/**
* 
*/
class DuringController extends Controller
{
	
	public function actionIndex(){

	}

	public function actionJson($page,$size){
		$size = (int)$size;
		$page = (int)$page;
		$offset = $size*($page-1);

		$data = Product::find()
		        ->select(['id','species_id','dorm','name','update_time'])
		        ->with(['species'=>function($query){
	                	$query->select('id,name');
	                },'message'=>function($query){

	                }]
                )
		        ->orderBy('id desc')
		        ->offset($offset)
		        ->limit($size)
		        ->where(['status'=>3])
		        ->asArray()
		        ->all();

        foreach ($data as $key => $value) {
        	$data[$key]['update_time'] = date('Y-m-d',$value['update_time']);
        	if (!is_null($value['message'])) {
        		$message = [];
        		if ($value['message']['forage']) {
        			array_push($message, '饲料改动');
        		}
        		if ($value['message']['feed_time']) {
        			array_push($message, '养殖时间改动');
        		}
        		if ($value['message']['kill_time']) {
        			array_push($message, '宰杀通知');
        		}

        		$data[$key]['message'] = $message;
        	}
        }
        var_dump($data);
	}

	public function actionUpdate($id){
		$id = (int)$id;
		$Product = Product::findOne($id);
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$update_status = $Product->updateInfo($post);

			if ($update_status['code']==0) {
				echo '更新成功';
			}else{
				echo '更新失败';
			}

		}
	}

	public function actionMessage($page,$size){
		$size = (int)$size;
		$page = (int)$page;
		$offset = $size*($page-1);

		$data = Product::find()
		        ->select(['t_product.id','species_id','dorm','t_product.name'])
		        ->joinWith(['species'=>function($query){
	                	$query->select('id,name');
	                },'message'=>function($query){
	                	// $query->where(['mid'=>2]);

	                }]
                )
		        ->orderBy('id desc')
		        ->offset($offset)
		        ->limit($size)
		        ->where(['status'=>3])
		        ->asArray()
		        ->all();

        
        foreach ($data as $key => $value) {
        	if (!is_null($value['message'])) {
        		$message = [];
        		if ($value['message']['forage']) {
        			$message['饲料改动'] = $value['message']['forage'];
        		}
        		if ($value['message']['feed_time']) {
        			$message['养殖时间改动'] = $value['message']['feed_time'];
        		}
        		if ($value['message']['kill_time']) {
        			$message['宰杀通知'] = $value['message']['kill_time'];
        		}

        		$data[$key]['message'] = $message;
        	}
        }
        var_dump($data);
	}

	public function actionResult($id){
		$id = (int)$id;

		$FarmResult = FarmResult::find()->where(['product_id'=>$id])->one();
		$Product = Product::findOne($id);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();

			$content = json_encode($post['content']);

			$update_status = $FarmResult->updateResult($content);

			if ($update_status['code'] == 0) {
				$Product->status = 4;
				$Product->save();
				echo '修改成功';
			}else{
				echo '修改失败';
			}
		}

	}
    
    public function actionToBatch(){
    	if (Yii::$app->request->isPost) {
    		$post = Yii::$app->request->post();

    		$ids = implode(',', $post);
    		$ids .= '('.')';

    		$data = Product::find()
    		        ->where('id In '.$ids)
    		        ->all();
    		print_r($data);
    	}
    }

	public function actionBatch(){

		$post = Yii::$app->request->post();
        
        $now_weight = $food_intake = $activity = $sleep = $fat_ratio = '';
        $ids = [];
	    foreach ($post as $key => $value) {
	    	$now_weight .= sprintf("WHEN %d THEN '%s' ", $value['id'], $value['now_weight']);
	    	$food_intake .= sprintf("WHEN %d THEN '%s' ", $value['id'], $value['food_intake']);
	    	$activity .= sprintf("WHEN %d THEN '%s' ", $value['id'], $value['activity']);
	    	$sleep .= sprintf("WHEN %d THEN '%s' ", $value['id'], $value['sleep']);
	    	$fat_ratio .= sprintf("WHEN %d THEN '%s' ", $value['id'], $value['fat_ratio']);
	    	$ids[]= $value['id'];
	    }
        
        $ids = implode(',', $ids);
		$sql = 'UPDATE '.Product::tableName().' SET ';
		$sql.= 'now_weight = CASE id '.$now_weight.'END, ';
		$sql.= 'food_intake = CASE id '.$food_intake.'END, ';
		$sql.= 'activity = CASE id '.$activity.'END, ';
		$sql.= 'sleep = CASE id '.$sleep.'END, ';
		$sql.= 'fat_ratio = CASE id '.$fat_ratio.'END ';
		$sql.= 'WHERE id IN ('.$ids.')';


		$rs = Yii::$app->db->createCommand($sql)->execute();

		print_r($rs);

	}
}