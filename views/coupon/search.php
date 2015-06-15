<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


$CouponCategoriesModel = $model['CouponCategories'];
$CouponModel = $model['Coupon'];

$form = ActiveForm::begin([
    'action' => Url::toRoute('coupon/search'),
    'method' => 'GET'
]);
//Check the checkbox if user searched for deals

$CouponModel->IsDeal = (Yii::$app->request->get('Coupon')['IsDeal'] == true);

$CouponCategoriesModel['CategoryID'] = $CategoryID;

$categoriesList = array();

foreach($categories as $category) {
	$categoriesList[$category["CategoryID"]] = $category["Name"];
}

echo $form->field($CouponModel, 'IsDeal')->checkbox(['label' => 'Show deals']);
echo Html::activeRadioList($CouponCategoriesModel, 'CategoryID', $categoriesList, ['label' => 'Required Coupon ID:']);

echo Html::submitButton('Find', ['class' => 'btn btn-primary']);

ActiveForm::end();

var_dump($coupons);
// if(sizeof($coupons) > 0) {	//Coupons are sent from the backend
// 	echo '<h1>';
// 	if($CouponModel->IsDeal)
// 		echo 'Deals:';
// 	else
// 		echo 'Coupons:';
// 	echo '</h1>';
// 	echo '<ol>';
// 	foreach($coupons as $coupon) {
// 		echo '<li>';
// 		echo var_dump($coupon->getAttributes([
// 				'CouponID',
// 				'CouponCode',
// 				'Title',
// 				'IsDeal'
// 			]));
// 		echo '</li>';
// 	}
// 	echo '</ol>';

	echo LinkPager::widget([
	    'pagination' => $pages,
	]);
// }
?>