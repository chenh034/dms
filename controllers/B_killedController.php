<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;

/**
* 
*/
class KilledController extends Controller
{
	
	public function actionJson($page,$size,$status){
		$size = (int)$size;
		$page = (int)$page;
		$offset = $size*($page-1);
		$status = (int)$status;

		$data = Product::find()
		        ->select(['id','species_id','name','type','end_time','output'])
		        ->with(['species'=>function($query){
		        	$query->select('id,name');
		        },'result'=>function($query){
		        	$query->select('product_id,total_weight');
		        }])
		        ->offset($offset)
		        ->limit($size)
		        ->orderBy('id desc')
		        ->where(['status'=>$status])
		        ->asArray()
		        ->all();

		print_r($data);
	}

	public function actionDetail($id){
        $id = (int)$id;

        $data = Product::find()
                ->select(['id','farm_id','species_id','name','start_time','end_time'])
                ->with(['species'=>function($query){
		        	$query->select('id,name');
		        },'result'=>function($query){
		        	$query->select('product_id,total_weight,content');
		        },'farm'=>function($query){
		        	$query->select('id,account_place');
		        }])
		        ->where(['id'=>$id])
		        ->asArray()
		        ->one();

		print_r($data);
	}

	public function actionAssignLog($id){
		
	}
}