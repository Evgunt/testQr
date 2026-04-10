<?php
    namespace app\controllers;
    use Yii;
    use yii\db\Exception;
    use yii\web\Controller;
    use yii\web\Response;
    use app\models\ShortUrl;
    class SiteController extends Controller
    {
        public function actionIndex(): string
        {
            return $this->render('index');
        }

        /**
         * @throws Exception
         */
        public function actionCreate(): array
        {
            Yii::$app->response->format=Response::FORMAT_JSON;
            $url=Yii::$app->request->post('url');
            if(!filter_var($url,FILTER_VALIDATE_URL)){
                return ['error'=>'Невалидный URL'];
            }
            $headers=@get_headers($url,1);
            if(!$headers || strpos($headers[0],'200')===false){
                return ['error'=>'Данный URL не доступен'];
            }
            $model=ShortUrl::findOne(['long_url'=>$url]);
            if(!$model){
                $model=new ShortUrl(['long_url'=>$url]);
                $model->generateHash();
                $model->save();
            }
            require Yii::getAlias('@vendor/phpqrcode/qrlib.php');
            $qrFile=Yii::getAlias('@webroot/qrcodes/'.$model->hash.'.png');
            if(!file_exists($qrFile)){
                \QRcode::png($model->getShortLink(),$qrFile,'L',6,2);
            }
            return [
                'hash'=>$model->getShortLink(),
                'qr'=>Yii::getAlias('@web/qrcodes/'.$model->hash.'.png'),
            ];
        }
    }
