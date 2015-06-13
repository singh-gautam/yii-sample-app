<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;

echo Html::a("Search", Url::toRoute('coupon/search'));
?>
<h1>Coupons</h1>
<ol>
	<?php foreach($coupons as $coupon) { ?>
	<li>
		<strong>Code: </strong> <u> <?= $coupon->CouponCode .' <br>' ?> </u>
		<strong>ID: </strong> <u> <?= $coupon->CouponID .'<br>' ?> </u>
		<strong>Success: </strong> <u> <?= $coupon->CountSuccess ?> </u>
	</li>
	<?php } ?>
</ol>

<h1>Deals</h1>
<ol>
	<?php foreach($deals as $deal) { ?>
	<li>
		<strong>Code: </strong> <u> <?= $deal->CouponCode .' <br>' ?> </u>
		<strong>ID: </strong> <u> <?= $deal->CouponID .'<br>' ?> </u>
		<strong>Success: </strong> <u> <?= $deal->CountSuccess ?> </u>
	</li>
	<?php } ?>
</ol>