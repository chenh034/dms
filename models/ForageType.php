<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class ForageType extends ActiveRecord
{  
	const AK = 'C1TMsgCZd50QiAnTq7i-3LFj5RnDbFfgVCSLDLZV';
    const SK = 'WMebdPN1pzZsjqz2i5OkIkvRaN2iJTD50Y7aSL-Q';
    const DOMAIN = 'oho3gx15s.bkt.clouddn.com';
    const BUCKET = 'dms-resource';
	
	public static function tableName(){
		return "{{%forage_type}}";
	}

	public function rules(){
		return [
           ['name','required','message'=>'饲料名称不能为空'],
           ['object','required','message'=>'饲养对象不能为空'],
           ['ingredient','required','message'=>'饲料成分不能为空'],
           ['introduce','required','message'=>'饲料介绍不能为空'],
           ['img_url','safe'],
		];
	}
	
	public function addForage($data){
        if ($this->load($data,'')) {
        	$this->createtime = time();
        	if ($this->save()) {
        		return ['code'=>0];
        	}else{
        		return ['code'=>1,'data'=>$this->getErrors()];
        	}
        }else{
        	return ['code'=>1,'data'=>'数据载入失败'];
        }
	}

	public function editForage($data){
		if ($this->load($data,'') && $this->save()) {
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
}