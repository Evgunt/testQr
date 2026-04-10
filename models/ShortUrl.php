<?php

    namespace app\models;

    use yii\db\ActiveRecord;
    use yii\helpers\Url;

    class ShortUrl extends ActiveRecord
    {
        /**
         * @var mixed|null
         */
        public $long_url;
        /**
         * @var false|string
         */
        public $hash;
        /**
         * @var mixed|null
         */
        public $id;

        public static function tableName(): string
        {
            return 'short_url';
        }

        public function rules(): array
        {
            return [
                [['long_url'], 'required'],
                [['long_url'], 'url'],
            ];
        }

        public function generateHash()
        {
            $this->hash = substr(md5(uniqid('', true)), 0, 8);
        }

        public function getShortLink(): string
        {
            return Url::base(true) . '/' . $this->hash;
        }
    }
