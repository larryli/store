<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user}}`.
 */
class m170711_055112_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            // http://stackoverflow.com/questions/35125933/mysql-utf8mb4-errors-when-saving-emojis
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'password_hash' => $this->string()->notNull()->comment('Hashed password'),
            'auth_key' => $this->string(32)->notNull()->comment('Cookie auth key'),
            'state' => $this->smallInteger()->notNull()->defaultValue(0)->comment('User state'),
            'created_at' => $this->integer()->notNull()->comment('Created timestamp'),
            'created_from' => $this->string()->notNull()->comment('Created ip'),
            'created_via' => $this->text()->notNull()->comment('Created user agent'),
            'updated_at' => $this->integer()->notNull()->comment('Updated timestamp'),
            'updated_from' => $this->string()->notNull()->comment('Updated ip'),
            'updated_via' => $this->text()->notNull()->comment('Updated user agent'),
            'last_logged_at' => $this->integer()->null()->comment('Last logged timestamp'),
            'last_logged_from' => $this->string()->null()->comment('Last logged ip'),
            'last_logged_via' => $this->text()->null()->comment('Last logged user agent'),
        ], $tableOptions);

        // creates index for column `state`
        $this->createIndex(
            'idx-user-state',
            '{{%user}}',
            'state'
        );

        // creates index for column `created_at`
        $this->createIndex(
            'idx-user-created_at',
            '{{%user}}',
            'created_at'
        );

        // creates index for column `updated_at`
        $this->createIndex(
            'idx-user-updated_at',
            '{{%user}}',
            'updated_at'
        );

        // creates index for column `last_logged_at`
        $this->createIndex(
            'idx-user-last_logged_at',
            '{{%user}}',
            'last_logged_at'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops index for column `last_logged_at`
        $this->dropIndex(
            'idx-user-last_logged_at',
            '{{%user}}'
        );

        // drops index for column `updated_at`
        $this->dropIndex(
            'idx-user-updated_at',
            '{{%user}}'
        );

        // drops index for column `created_at`
        $this->dropIndex(
            'idx-user-created_at',
            '{{%user}}'
        );

        // drops index for column `state`
        $this->dropIndex(
            'idx-user-state',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
