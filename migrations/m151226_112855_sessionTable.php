<?php

use yii\db\Schema;
use yii\db\Migration;

class m151226_112855_sessionTable extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE session
            (
                id CHAR(40) NOT NULL PRIMARY KEY,
                expire INTEGER,
                data BLOB
            )");
    }

    public function down()
    {
        $this->dropTable('session');
    }
}
