<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Species;
use app\models\Setmeal;
use app\models\FarmMessage;
use app\models\FarmResult;
use app\models\FarmUser;

/**
* 
*/
class Product extends ActiveRecord
{   
	const AK = 'C1TMsgCZd50QiAnTq7i-3LFj5RnDbFfgVCSLDLZV';
    const SK = 'WMebdPN1pzZsjqz2i5OkIkvRaN2iJTD50Y7aSL-Q';
    const DOMAIN = 'oho3gx15s.bkt.clouddn.com';
    const BUCKET = 'dms-resource';
	
	public static function tableName(){
		return "{{%product}}";
	}

	public function rules(){
		return [
           ['farm_id','required','message'=>'所属养殖户不能为空','on'=>['add_1','add_2']],
           ['name','required','message'=>'编号不能为空','on'=>['add_1','add_2']],
           ['species_id','required','message'=>'所属物种不能为空','on'=>['add_1','add_2']],
           ['foundation_weight','required','message'=>'30天体重不能为空','on'=>['add_1','add_2']],
           ['pre_weight','required','message'=>'预计出肉不能为空','on'=>['add_1','add_2']],
           ['now_weight','safe'],
           ['type','required','message'=>'产品种类不能为空','on'=>['add_1','add_2']],
           ['foundation_price','required','message'=>'所属养殖户不能为空','on'=>['add_1','add_2']],
           ['feed_price','required','message'=>'养殖费用不能为空','on'=>['add_1','add_2']],
           ['introduce','required','message'=>'介绍不能为空','on'=>['add_1','add_2']],
           ['img_url','required','message'=>'图片不能为空','on'=>['add_1','add_2']],
           ['start_time','required','message'=>'开始养殖时间不能为空','on'=>['add_2']],
           ['end_time','required','message'=>'结束养殖时间不能为空','on'=>['add_2']],
           ['dorm','required','message'=>'猪舍不能为空','on'=>['assign_dorm']],
           ['food_intake','safe'],
           ['activity','safe'],
           ['sleep','safe'],
           ['fat_ratio','safe'],
           ['advice','safe'],
           ['update_time','safe'],
           ['output','safe'],
           ['rate','safe'],
           ['status','safe'],
           ['is_ok','safe'],
		];
	}

	public function getSpecies(){
		return $this->hasOne(Species::className(),['id'=>'species_id']);
	}

	public function getSetmeal(){
		return $this->hasMany(Setmeal::className(),['product_id'=>'id']);
	}

	public function getMessage(){
		return $this->hasOne(FarmMessage::className(),['product_id'=>'id']);
	}

	public function getResult(){
		return $this->hasOne(FarmResult::className(),['product_id'=>'id']);
	}

	public function getFarm(){
		return $this->hasOne(FarmUser::className(),['id'=>'farm_id']);
	}

	public function addProduct($data){
		if ($data['type'] == 1) {
		    $this->scenario = "add_1";			
		}else if ($data['type'] == 2) {
			$this->scenario = "add_2";
		}
		if ($this->load($data,'')) {
			$this->update_time = time();
			if ($this->save()) {
				return ['code'=>0,'data'=>['product_id'=>$this->id]];
			}else{
				return ['code'=>1,'data'=>$this->getErrors()];
			}
		}
	}

	public function editProduct($data){
		$this->scenario = "add_1";
		if ($this->load($data,'')) {
			$this->update_time = time();
			if ($this->save()) {
				return ['code'=>0];
			}else{
				return ['code'=>1,'data'=>$this->getErrors()];
			}
		}
	}

	public function updateInfo($data){
		if ($this->load($data,'')) {
			$this->update_time = strtotime($data['update_time']);
		    if ($this->save()) {
		    	return ['code'=>0];
		    }else{
		    	return ['code'=>1];
		    }
		}else{
			return ['code'=>1];
		}
	}
	
}