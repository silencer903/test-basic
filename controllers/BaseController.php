<?php
/**
 * Created by PhpStorm.
 * User: Shamil
 * Date: 10.11.2015
 * Time: 10:54
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller{

    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);
        /*if (\Yii::$app->user->isGuest) {
            //$this->goHome();
            $this->redirect(\Yii::$app->urlManager->createUrl("site/login"));
        }elseif(!\Yii::$app->user->identity->id_vk_accounts and \Yii::$app->user->identity->permissions_id==3){
            //$this->redirect(\Yii::$app->urlManager->createUrl("site/changevk"));
        }*/
        return $result;
    }
} 