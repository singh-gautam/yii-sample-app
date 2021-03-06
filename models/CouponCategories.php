<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CouponCategories".
 *
 * @property integer $CategoryID
 * @property string $Name
 * @property string $URLKeyword
 * @property integer $Priority
 * @property string $ImageLink
 * @property string $Title
 * @property string $MetaDescription
 * @property integer $NumActiveCoupons
 * @property string $CategoryImageColourCode
 * @property integer $FeaturedOnAppHome
 * @property double $CategoryPopularityScore
 * @property string $Images
 */
class CouponCategories extends \yii\db\ActiveRecord
{

    public $pages;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponCategories';
    }
	
	public function __construct() {
		parent::__construct();
		$this->pages = null;
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['URLKeyword', 'ImageLink', 'MetaDescription'], 'required'],
            [['Priority', 'NumActiveCoupons', 'FeaturedOnAppHome'], 'integer'],
            [['ImageLink', 'Title', 'MetaDescription', 'Images'], 'string'],
            [['CategoryPopularityScore'], 'number'],
            [['Name', 'URLKeyword'], 'string', 'max' => 200],
            [['CategoryImageColourCode'], 'string', 'max' => 50],
            [['Name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryID' => 'Category ID',
            'Name' => 'Name',
            'URLKeyword' => 'Urlkeyword',
            'Priority' => 'Priority',
            'ImageLink' => 'Image Link',
            'Title' => 'Title',
            'MetaDescription' => 'Meta Description',
            'NumActiveCoupons' => 'Num Active Coupons',
            'CategoryImageColourCode' => 'Category Image Colour Code',
            'FeaturedOnAppHome' => 'Featured On App Home',
            'CategoryPopularityScore' => 'Category Popularity Score',
            'Images' => 'Images',
        ];
    }
	
	public function getCategoryCoupons()
	{
		return $this->hasMany(Coupon::className(), ['CouponID' => 'CouponID'])
                ->select(['CouponID', 'CouponCode', 'Title'])
				->orderBy('CouponID')
				->viaTable('CouponCategoryInfo' ,['CategoryID' => 'CategoryID']);
	}
	
	public function fetchDistinctCategories($select = [], $offset = 0, $limit = -1) {

		$query = CouponCategories::find();
		if(sizeof($select) > 0) {
			$query = $query->select($select);
		}
		$query = $query->offset($offset);
		
		if($limit != -1) {
			$query = $query->limit($limit);
		}
		return $query->distinct()->all();	
	}
}
