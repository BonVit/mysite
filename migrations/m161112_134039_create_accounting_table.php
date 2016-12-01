<?php

use yii\db\Migration;

/**
 * Handles the creation of table `accounting`.
 * Has foreign keys to the tables:
 *
 * - `variants`
 */
class m161112_134039_create_accounting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('accounting', [
            'id' => $this->primaryKey(),
            'variants_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'operation_type' => $this->string()->notNull()->defaultValue('expense'),
            'date' => $this->integer()->notNull(),
        ]);

        // creates index for column `variants_id`
        $this->createIndex(
            'idx-accounting-variants_id',
            'accounting',
            'variants_id'
        );

        // add foreign key for table `variants`
        $this->addForeignKey(
            'fk-accounting-variants_id',
            'accounting',
            'variants_id',
            'variants',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `variants`
        $this->dropForeignKey(
            'fk-accounting-variants_id',
            'accounting'
        );

        // drops index for column `variants_id`
        $this->dropIndex(
            'idx-accounting-variants_id',
            'accounting'
        );

        $this->dropTable('accounting');
    }
}
