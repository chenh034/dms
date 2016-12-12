<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class ProductComment extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%product_comment}}";
	}
	
}