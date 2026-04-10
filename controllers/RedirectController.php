<?php
    namespace app\controllers;
    use Yii;
    use yii\db\Exception;
    use yii\web\Controller;
    use app\models\ShortUrl;
    use app\models\Log;
    use yii\web\NotFoundHttpException;

    class RedirectController extends Controller
    {
        /**
         * @throws Exception
         * @throws NotFoundHttpException
         */
        public function actionGo($hash): \yii\web\Response
        {
            $url=ShortUrl::findOne(['hash'=>$hash]);
            if(!$url) throw new \yii\web\NotFoundHttpException();
            $log=new Log();
            $log->url_id=$url->id;
            $log->ip=Yii::$app->request->userIP;
            $log->save();
            $url->updateCounters(['counter'=>1]);
            return $this->redirect($url->long_url);
        }
    }
