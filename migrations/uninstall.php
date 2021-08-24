<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        // $this->dropTable('sponsor');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}
