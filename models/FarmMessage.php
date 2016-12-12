<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Product;

/**
* 
*/
class FarmMessage extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%farm_message}}";
	}

	public function getProduct(){
		return $this->hasOne(Product::className(),['id'=>'product_id']);
	}
	
}