<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $itemName
 * @property string $description
 * @property double $price
 * @property string $author
 * @property string $product_image
 * @property int $stock_quantity
 * @property string $category_id
 *
 * @property Category $category
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemName', 'description', 'price', 'author', 'product_image', 'stock_quantity', 'category_id'], 'required'],
            [['price'], 'number'],
            [['stock_quantity'], 'integer'],
            [['itemName', 'author', 'category_id'], 'string', 'max' => 64],
            [['description', 'product_image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'itemName' => Yii::t('app', 'Item Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'author' => Yii::t('app', 'Author'),
            'product_image' => Yii::t('app', 'Product Image'),
            'stock_quantity' => Yii::t('app', 'Stock Quantity'),
            'category_id' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['name' => 'category_id'])->inverseOf('products');
    }

    /**
     * @inheritdoc
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
