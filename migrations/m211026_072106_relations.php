<?php

use yii\db\Migration;

/**
 * Class m211026_072106_relations
 */
class m211026_072106_relations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->execute("CREATE TABLE relations(
	dep_id BIGINT UNSIGNED not null,
	emp_id BIGINT UNSIGNED not null,
    primary key(dep_id,emp_id),
    foreign key (dep_id) references departments(dep_id) on delete cascade on update no action,
    foreign key (emp_id) references employees(emp_id)	on delete cascade on update no action
)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('relations');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211026_072106_relations cannot be reverted.\n";

        return false;
    }
    */
}
