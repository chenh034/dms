<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
* 
*/
class IndexController extends Controller
{
	
	public function actionIndex(){
		echo 'hello';
	}

	public function actionTest(){
		echo 222;
	}
}