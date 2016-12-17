<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use app\models\ProductComment;

/**
* 
*/
class C_indexController extends Controller
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
        
        $Comment = ProductComment::find()
                   ->with('pics')
                   ->limit(3)
                   ->orderBy('id desc')
                   ->where(['is_index_show'=>1])
                   ->asArray()
                   ->all();

        $data['product'] = $Product;
        $data['Comment'] = $Comment;

        print_r($data);
	}
}