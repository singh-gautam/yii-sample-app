<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$form = ActiveForm::begin([
    'action' => Url::to(['coupon/search']),
    'method' => 'GET'
]);
//Check the checkbox if user searched for deals
$model->IsDeal = (Yii::$app->request->get('Coupon')['IsDeal'] == true);

echo $form->field($model, 'IsDeal')->checkbox(['label' => 'Show deals']);
echo Html::submitButton('Find', ['class' => 'btn btn-primary']);

ActiveForm::end();

if(sizeof($coupons) > 0) {	//Coupons are sent from the backend
	echo '<h1>';
	if($model->IsDeal)
		echo 'Deals:';
	else
		echo 'Coupons:';
	echo '</h1>';
	echo '<ol>';
	foreach($coupons as $coupon) {
		echo '<li>';
		echo var_dump($coupon->getAttributes([
				'CouponID',
				'CouponCode',
				'Title',
				'IsDeal'
			]));
		echo '</li>';
	}
	echo '</ol>';

	echo LinkPager::widget([
	    'pagination' => $pages,
	]);
}
?>