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
            'store'=>$this->string(200),
            'date_created'=>$this->dateTime(),
            'date_updated'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201211_075141_device cannot be reverted.\n";

        return false;
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
