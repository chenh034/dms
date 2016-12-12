<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Species extends ActiveRecord
{   
	const AK = 'C1TMsgCZd50QiAnTq7i-3LFj5RnDbFfgVCSLDLZV';
    const SK = 'WMebdPN1pzZsjqz2i5OkIkvRaN2iJTD50Y7aSL-Q';
    const DOMAIN = 'oho3gx15s.bkt.clouddn.com';
    const BUCKET = 'dms-resource';
	
	public static function tableName(){
		return "{{%species}}";
	}

	public function rules(){
		return [
           ['name','required','message'=>'物种名称不能为空'],
           ['parent_id','required','message'=>'物种类别不能为空'],
           ['special','required','message'=>'物种特色不能为空'],
           ['introduce','required','message'=>'物种介绍不能为空'],
           ['img_url','safe','message'=>''],
		];
	}

	public function getItems(){

	}


	public function addSpecies($data){
		$this->load($data,'');
		$this->createtime = time();
		if ($this->save()) {
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}

	}

	public function editSpecies($data){
		if ($this->load($data,'') && $this->save()) {
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}

	}

	
}