<?php

    namespace app\models;

    use yii\db\ActiveRecord;

    class Log extends ActiveRecord
    {
        /**
         * @var mixed|null
         */
        public $url_id;
        /**
         * @var mixed|string|null
         */
        public $ip;

        public static function tableName(): string
        {
            return 'log';
        }
    }
