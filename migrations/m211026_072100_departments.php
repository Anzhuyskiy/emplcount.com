<?php

use yii\db\Migration;

/**
 * Class m211026_072100_departments
 */
class m211026_072100_departments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("create table departments(
                            dep_id BIGINT UNSIGNED AUTO_INCREMENT,
                            dep_name varchar(255) not null,
                            primary key(dep_id)
                            )
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('departments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211026_072100_departments cannot be reverted.\n";

        return false;
    }
    */
}
