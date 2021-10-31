<?php

use yii\db\Migration;

/**
 * Class m211026_072050_employees
 */
class m211026_072050_employees extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
                            create table employees(
                            user_id int,
                            emp_id BIGINT UNSIGNED AUTO_INCREMENT,
                            emp_name varchar(255) not null,
                            primary key(emp_id),
                            foreign key(user_id) references users(user_id) on delete cascade
                            )
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('employees');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211026_072050_employees cannot be reverted.\n";

        return false;
    }
    */
}
