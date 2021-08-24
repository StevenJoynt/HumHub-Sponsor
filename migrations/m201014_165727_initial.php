<?php

use yii\db\Migration;

class m201014_165727_initial extends Migration
{

    public function up()
    {
        if ( $this->getDb()->getTableSchema('sponsor', true) === null ) {
            $this->createTable('sponsor', [
                'id' => 'pk',
                'invited_id' => 'int(11) DEFAULT NULL',
                'invited_email' => 'text NOT NULL',
                'created_by' => 'int(11) NOT NULL',
                'created_name' => 'text NOT NULL',
                'created_email' => 'text NOT NULL',
            ]);
            $this->createIndex('idx_sponsor_invited_id', 'sponsor', 'invited_id', false);
            $this->createIndex('idx_sponsor_created_by', 'sponsor', 'created_by', false);
            $this->addForeignKey('fk_sponsor_invited_id', 'sponsor', 'invited_id', 'user', 'id', 'CASCADE');
        }
    }

    public function down()
    {
        echo "m201014_165727_initial cannot be reverted.\n";
        return false;
    }

}
