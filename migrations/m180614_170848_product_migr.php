<?php

use yii\db\Migration;

/**
 * Class m180614_170848_product_migr
 */
class m180614_170848_product_migr extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->addForeignKey(
            'products_ibfk_1',
            'products',
            'category_id',
            'category',
            'name',
            'RESTRICT'
        );
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'itemName' => $this->string(64)->notNull(),
            'description' => $this->string(255)->notNull(),
            'price' => $this->float()->notNull(),
            'author' => $this->string(64)->unique()->notNull(),
            'product_image' => $this->string(255)->notNull(),
            'stock_quantity' => $this->integer(64)->notNull(),
            'category_id' => $this->string(64)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'products_ibfk_1',
            'products'
        );

        $this->dropTable('products');
    }

}
