<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\InputForm;
use app\models\ReturnForm;

class InputController extends Controller
{
    
    public function actionInput()
    {
        $model = new InputForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            return $this->render('input-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('input', ['model' => $model]);
        }
    }

    public function actionReturn()
    {
        $model = new ReturnForm();
        if($model->load(Yii::$app->request->post(),"")){
            return $model->ReturnMessage();
        }
        Yii::info(Yii::$app->request->post());
        return $model->ReturnMessage();
	}

	public function actionGetorders()
    {
        $model = new ReturnForm();
        if($model->load(Yii::$app->request->post(),"")){
            return $this->renderPartial('ordersTable',['orders'=>$model->getOrders()]);
        }
    }

    public function actionSaveorupdateorders()
    {
        $model = new ReturnForm();
        if($model->load(Yii::$app->request->post(),"")){
            return $model->saveOrUpdateOrder();
         }
    }
}