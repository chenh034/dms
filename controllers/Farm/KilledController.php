<?php 

namespace app\controllers\farm;

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
		        }])
		        ->where(['status'=>$status])
		        ->asArray()
		        ->all();

		print_r($data);
	}
}