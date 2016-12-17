<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\Controller;

/**
* 
*/
class WaitController extends Controller
{
	public function actionIndex(){

	}

	public function actionConfirm($id){
		$Product = Product::findOne($id);
		$Product->status = 3;
		if ($Product->save()) {
			echo '0';
		}else{
			echo '1';
		}

	}


	public function actionJson($page,$size){
		$size = (int)$size;
		$page = (int)$page;
		$offset = $size*($page-1);

		$data = Product::find()
		        ->select(['id','species_id','type','name','foundation_price','feed_price','start_time','end_time','img_url'])
		        ->with(['species'=>function($query){
	                	$query->select('id,name');
	                },'setmeal'=>function($query){
	                	$query->where(['buy'=>1]);
	                }]
                )
		        ->orderBy('id desc')
		        ->offset($offset)
		        ->limit($size)
		        ->where(['status'=>2])
		        ->asArray()
		        ->all();

		foreach ($data as $key => $value) {
			if ($value['type']==1) {
				$days = (strtotime($value['end_time'])-strtotime($value['start_time']))/(3600*24);
				$data[$key]['total_price'] = $value['foundation_price']+$days*$value['feed_price'];
			}else if ($value['type']==2) {
				$total_price = 0;
				foreach ($value['setmeal'] as $k => $v) {
					$total_price += (int)$v['price'];
					$data[$key]['total_price'] = $total_price;
				}
			}

			if ($value['type']==1) {
				$data[$key]['type'] = '认养';
				$data[$key]['belong'] = 1;
			}else if ($value['type']==2) {
				$data[$key]['type'] = '共筹';
				$data[$key]['belong'] = sizeof($data[$key]['setmeal']);
			}


		}

		print_r($data);

	}
}