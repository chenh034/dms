<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\CommentPic;

/**
* 
*/
class ProductComment extends ActiveRecord
{
	const AK = 'C1TMsgCZd50QiAnTq7i-3LFj5RnDbFfgVCSLDLZV';
    const SK = 'WMebdPN1pzZsjqz2i5OkIkvRaN2iJTD50Y7aSL-Q';
    const DOMAIN = 'oho3gx15s.bkt.clouddn.com';
    const BUCKET = 'dms-resource';

	public static function tableName(){
		return "{{%product_comment}}";
	}

	public function rules(){
		return [
           ['user_id','safe'],
           ['product_id','required','message'=>'产品id不能为空'],
           ['content','required','message'=>'评论内容不能为空'],
           ['main_level','required','message'=>'出肉评价不能为空'],
           ['fresh_level','required','message'=>'新鲜度评价不能为空'],
           ['log_level','required','message'=>'物流评价不能为空']
		];
	}

	public function getPics(){
		return $this->hasMany(CommentPic::className(),['comment_id'=>'id']);
	}

	public function addComment($data){
		if ($this->load($data,'')) {
			$this->createtime = time();
			if ($this->save()) {
				return ['code'=>0,'data'=>['comment_id'=>$this->id]];
			}else{
				return ['code'=>1,'data'=>$this->getErrors()];
			}
		}
	}
	
}