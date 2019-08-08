<?php

namespace app\models;

use yii;
use yii\base\Model;

class ReturnForm extends Model{

    public $qwe;
    public $id_order;
    public $fio;
    public $result;
    public $order;


    public function rules()
    {
        return[
            [['qwe', 'id_order', 'fio'], 'string'],
        [['order'],'exist', 'allowArray' => true]
        ];
    }

     public function ReturnMessage()
    {
        $id_order=$this->id_order;
        $fio=$this->fio;
        $order=$this->order;
        Yii::info($fio." in model");
        Yii::info($id_order." in model");
        Yii::info($order);
        $result=[];
        $result['id_order']=$id_order;
        $result['fio']=$fio;
        return json_encode($result);
    }
    public function getOrders()
    {
        $connection=Yii::$app->db;
        $id_order=$this->id_order;
        if($id_order){
            $orders=$connection->createCommand("SELECT * FROM orders WHERE id_orders=:id")
                ->bindValue(":id",$id_order)
                ->queryAll();
        }else{
            $orders=$connection->createCommand("SELECT * FROM orders")
                ->queryAll();
        }
        Yii::info($id_order." in model");


        Yii::info($orders);
        return $orders;
    }

    public function saveOrUpdateOrder(){
        $connection=Yii::$app->db;
        $order=$this->order;

        if($order){
            $order_from_db=$connection->createCommand("SELECT * FROM orders WHERE id_orders=:id")
                ->bindValue(":id",$order['id_order'])
                ->queryOne();
            if($order_from_db){
                $connection->createCommand()->update("orders",['fio'=>$order['fio']],['id_orders'=>$order['id_order']])->execute();
            }else{
                $connection->createCommand()->insert("orders",['fio'=>$order['fio']])->execute();
            }

            return 'ok';
        }
    }
}
