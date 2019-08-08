<?php
/**
 * Created by PhpStorm.
 * User: Silencer
 * Date: 12.11.2017
 * Time: 16:25
 */

namespace app\models;


use DateTime;
use Exception;
use Yii;
use yii\base\UserException;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet_Drawing;

class MaterialsStock extends BaseClass
{
    public $id_materials;
    public $name;
    public $material;
    public $materials;
    public $get_colors=0;
    public $id_orders_materials=0;
    public $count_materials=0;
    public $from_order;
    public $id_materials_stock_orders;
    public $id_materials_suppliers;
    public $delivery_price=0;
    public $id_products_colors_carcass;
    public $id_products_colors_sewing;
    public $id_products_insert;
    public $id_products;
    public $id_factory_stocks_products;
    public $counts;
    public $number_nakladnaya;
    public $number_doverenost;
	public $date_nakladnaya;
	public $date_time_get_order;
	public $find_orders_materials_stock;
	public $date_from;
	public $date_to;
	public $id_drivers;
	public $driver;
	public $order_materials;
	public $id_materials_stock_orders_types;


    public function rules()
    {
        return [
            [['name', 'date_nakladnaya','find_orders_materials_stock','date_from','date_to','date_time_get_order'], 'string'],
            [['id_materials','get_colors','id_orders_materials','count_materials','from_order','id_materials_stock_orders','close_order','delivery_price','id_materials_suppliers','id_products_colors_carcass','id_products_colors_sewing','id_products_insert','id_products','id_factory_stocks_products','counts','number_nakladnaya','number_doverenost','id_drivers','id_materials_stock_orders_types'], 'integer'],
            [['material','materials','driver','order_materials'], 'exist', 'allowArray' => true]
        ];
    }


    public function getMaterials(){
        $connection=Yii::$app->db;
        $materials=$connection->createCommand("SELECT m.* FROM materials AS m  WHERE m.deleted=0 ORDER BY id_materials")->queryAll();

        return $materials;
    }

}