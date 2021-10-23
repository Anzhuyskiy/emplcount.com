<?php

use yii\db\Migration;

/**
 * Class m211019_183900_users
 */
class m211019_183900_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->execute("
            CREATE table users(
                user_id integer not null AUTO_INCREMENT,
                email varchar(255) not null,
                password varchar(255) not null,
                date_added timestamp default current_timestamp,
                PRIMARY KEY (user_id)
            )"
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211019_183900_users cannot be reverted.\n";

        return false;
    }
    */
}
