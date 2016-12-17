<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Handbook extends ActiveRecord
{
	
	const AK = 'C1TMsgCZd50QiAnTq7i-3LFj5RnDbFfgVCSLDLZV';
    const SK = 'WMebdPN1pzZsjqz2i5OkIkvRaN2iJTD50Y7aSL-Q';
    const DOMAIN = 'oho3gx15s.bkt.clouddn.com';
    const BUCKET = 'dms-resource';

	public static function tableName(){
		return "{{%handbook}}";
	}

	public function rules(){
		return [
           ['title','required','message'=>'标题不能为空'],
           ['content','required','message'=>'内容不能为空'],
           ['img_url','safe'],
           ['update_time','safe']
		];
	}

	public function addArticle($data){
		if ($this->load($data,'') && $this->validate()) {
			$this->save();
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}

	public function editArticle($data){
		if ($this->load($data,'') && $this->validate()) {
			$this->save();
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
	
}