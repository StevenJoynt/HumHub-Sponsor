<?php

use yii\db\Migration;

class m210211_114019_lowercase extends Migration
{

    public function up()
    {
        $this->execute('UPDATE sponsor SET invited_email = LOWER(invited_email)');
        $this->execute('UPDATE sponsor SET created_email = LOWER(created_email)');
    }

    public function down()
    {
        echo "m210211_114019_lowercase cannot be reverted.\n";
        return false;
    }

}
