<?php

    use yii\db\Migration;

    class m000000_000000_create_tables extends Migration
    {
        public function safeUp()
        {
            $this->createTable('short_url', [
                'id' => $this->primaryKey(),
                'long_url' => $this->text()->notNull(),
                'hash' => $this->string(8)->unique()->notNull(),
                'counter' => $this->integer()->defaultValue(0),
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            ]);
            $this->createTable('log', [
                'id' => $this->primaryKey(),
                'url_id' => $this->integer()->notNull(),
                'ip' => $this->string(45)->notNull(),
                'visited_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            ]);
            $this->addForeignKey(
                'fk_log_url',
                'log',
                'url_id',
                'short_url',
                'id',
                'CASCADE'
            );
        }

        public function safeDown()
        {
            $this->dropTable('log');
            $this->dropTable('short_url');
        }
    }
