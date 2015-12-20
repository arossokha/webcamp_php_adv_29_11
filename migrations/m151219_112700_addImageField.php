<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_112700_addImageField extends Migration
{
    public function up()
    {
        $this->addColumn('User','image',Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('User','image');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
