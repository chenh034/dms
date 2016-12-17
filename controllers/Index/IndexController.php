<?php

namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\Product;

/**
* 
*/
class IndexController extends Controller
{
	
	public function actionIndex(){
		$Product = Product::find()->select(['id','farm_id','species_id','foundation_weight','img_url','rate'])
                ->with(['species'=>function($query){
                	$query->select('id,name');
                },'farm'=>function($query){
		        	$query->select('id,account_place');
		        }])
                ->limit(4)
                ->orderBy('rate desc')
                ->asArray()
                ->all();
        print_r($Product);
	}
}