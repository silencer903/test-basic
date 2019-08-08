<?php
/**
 * Created by PhpStorm.
 * User: Silencer
 * Date: 12.11.2017
 * Time: 16:26
 */

namespace app\controllers;


use app\models\Clients;
use app\models\MaterialsStock;
use Yii;

class MaterialsstockController extends BaseController
{
    public $defaultAction = 'default';

    public function actionDefault(){
        return $this->render("default");
    }

    public function actionGetmaterials(){
        $model=new MaterialsStock();
        return $this->renderPartial("materials",['materials'=>$model->getMaterials()]);
    }

}