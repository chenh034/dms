<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class CommentPic extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%comment_pic}}";
	}

	public function rules(){
		return [
           ['comment_id','safe'],
           ['img_url','safe']
		];
	}
	
}