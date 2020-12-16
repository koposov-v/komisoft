<?php

use yii\db\Migration;

/**
 * Class m201211_075141_device
 */
class m201211_075141_device extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device',[
            'id'=>$this->primaryKey(),
            'store'=>$this->string(),
            'date_created'=>$this->dateTime()->notNull(),
            'date_updated'=>$this->dateTime()->notNull(),
            'store_id'=>$this->integer()->defaultValue(1),
        ]);
        // creates index for column `store_id`
        $this->createIndex(
            'idx-device-store_id',
            'device',
            'store_id'
        );

        // add foreign key for table `store`
        $this->addForeignKey(
            'fk-device-store_id',
            'device',
            'store_id',
            'store',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('device');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_075141_device cannot be reverted.\n";

        return false;
    }
    */
}
