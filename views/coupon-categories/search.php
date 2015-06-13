<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$form = ActiveForm::begin([
	'action' => Url::toRoute('coupon-categories/search'),
	'method' => 'GET'
]);

$model->CategoryID = $CategoryID;

$categoriesList = array();

foreach($categories as $category) {
	$categoriesList[$category["CategoryID"]] = $category["Name"];
}


echo Html::activeRadioList($model, 'CategoryID', $categoriesList, ['label' => 'Required Coupon ID:']);

echo Html::submitButton('Search', [
	'class' => 'btn btn-success'
]);

$form->end();

var_dump($coupons);

if($CategoryID != '') {
	echo LinkPager::widget([
	    'pagination' => $pages,
	]);
}
?>