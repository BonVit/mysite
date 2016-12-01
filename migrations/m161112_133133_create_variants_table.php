<?php

use yii\db\Migration;

/**
 * Handles the creation of table `variants`.
 * Has foreign keys to the tables:
 *
 * - `products`
 */
class m161112_133133_create_variants_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('variants', [
            'id' => $this->primaryKey(),
            'products_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
        ]);

        // creates index for column `products_id`
        $this->createIndex(
            'idx-variants-products_id',
            'variants',
            'products_id'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-variants-products_id',
            'variants',
            'products_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-variants-products_id',
            'variants'
        );

        // drops index for column `products_id`
        $this->dropIndex(
            'idx-variants-products_id',
            'variants'
        );

        $this->dropTable('variants');
    }
}
