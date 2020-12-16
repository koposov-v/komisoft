<?php

use yii\db\Migration;

/**
 * Class m201211_081826_store
 */
class m201211_081826_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('store',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull()->unique(),
            'date_created'=>$this->dateTime(),
            'date_updated'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('store');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_081826_store cannot be reverted.\n";

        return false;
    }
    */
}
