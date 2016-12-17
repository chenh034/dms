<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Question extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%question}}";
	}

	public function rules(){
		return [
           ['type_id','required','message'=>'问题类别不能为空'],
           ['title','required','message'=>'标题不能为空'],
           ['answer','required','message'=>'答案内容不能为空']
		];
	}

	public function addQuestion($data){
		if ($this->load($data,'') && $this->validate()) {
		    $this->save();
		    return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}

	public function editQuestion($data){
		if ($this->load($data,'') && $this->validate()) {
		    $this->save();
		    return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
	
}