<?php
/**
 * Created by PhpStorm.
 * User: Silencer
 * Date: 12.11.2017
 * Time: 17:13
 */

/* @var $materials array*/
/*foreach ($materials as $material){
    echo $material['name'].'  <span style="color: red">'.$material['counts']. '</span> '.$material['measure'].'<br>';
}*/
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/materials.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/cash.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<ul class="nav nav-tabs" role="tablist" id="nav-statistics">
    <li class="active"><a href="#materials" role="tab" data-toggle="tab" onclick="getMaterials()">Материалы</a></li>
    <li><a href="#drivers" role="tab" data-toggle="tab" onclick="getDrivers()">Довер. лица</a></li>
    <li><a href="#materials_stock_orders" role="tab" data-toggle="tab" onclick="getMaterialsStockOrders()">Заказы матриалов у поставщика</a></li>
    <li><a href="#materials_stock_orders_reports" role="tab" data-toggle="tab" onclick="getMaterialsStockOrdersReports()">Отчет по материалам</a></li>
    <li><a href="#materials_stock" role="tab" data-toggle="tab" onclick="getMaterialsStock()">Склад</a></li>

</ul>


<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="materials">
        <div class="panel panel-default">
            <div class="panel-heading form-inline">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-send="materials/getmaterial" data-backdrop="static" data-id="0" onclick="getMaterial(0)" id="btn-newmaterial">
                        <span class="glyphicon glyphicon-file"></span> Новый материал
                    </button>
                </div>
            </div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Наименование</td>
                        <td>Единицы измерения</td>
                        <td>Цех</td>
                        <td>Поставщик/Клиент</td>
                        <td>Себестоим.</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id="tbody-materials"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="drivers">
        <div class="panel panel-default">
            <div class="panel-heading form-inline">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-send="" data-backdrop="static" data-id="0" onclick="getDriver()" id="btn-newdriver">
                        <span class="glyphicon glyphicon-file"></span> Добавить водителя
                    </button>
                </div>

            </div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Фио водителя</td>
                        <td>Должность</td>
                        <td>№ и серия паспорта</td>
                        <td>Кем выдан</td>
                        <td>Дата выдачи</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id="tbody-drivers"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="materials_stock_orders">
        <div class="panel panel-default">
            <div class="panel-heading form-inline">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-send="" data-backdrop="static" data-id="0" onclick="getMaterialsStockOrder(0)" id="btn-newordermaterials">
                        <span class="glyphicon glyphicon-file"></span> Новый заказ материалов
                    </button>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <strong>Период</strong>
                        с <input type="date" class="form-control" placeholder="Начальная дата" onchange="getMaterialsStockOrders()" value="<?=date("Y-m-01");?>" id="date_from_materials_stock_orders">
                        по <input type="date" class="form-control" placeholder="Конечная дата" onchange="getMaterialsStockOrders()" value="<?php  if(date("Y-m-d")==date("Y-m-01")){echo date("Y-m-02");}else{echo date("Y-m-d");}?>" id="date_to_materials_stock_orders">
                    </div>
                </div>
                <!--<div class="form-group">
                    <label for="orders-materials">Заказы материалов:</label>
                    <select id="orders-materials">

                    </select>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-backdrop="static" onclick="getMaterialsStockOrder()" id="btn-openordermaterials">
                        <span class="glyphicon glyphicon-file"></span> Открыть заказ на материал
                    </button>
                </div>-->
                <div class="form-group">
                    <input type="text" id="find-order-materialsStock" style="width: 320px;" class="form-control" placeholder="Поиск по № накладной,№ заказа, материалу" name="find">
                    <button class="btn btn-default" type="button" id="btn-find" onclick="getMaterialsStockOrders()">Найти</button>
                </div>
            </div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>№ заказа</td>
                        <td>Дата</td>
                        <td>Дата прихода</td>
                        <td>Поставщик</td>
                        <td>Доставка</td>
                        <td>Оплата</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody id="tbody-materials_stock_orders"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="materials_stock_orders_reports">
        <div class="panel panel-default">
            <div class="panel-heading form-inline">
                <strong>Период</strong>
                с <input type="date" class="form-control" placeholder="Начальная дата" value="<?=date("Y-m-01");?>" id="materials-stock-orders-date_from">
                по <input type="date" class="form-control" placeholder="Конечная дата" value="<?php  if(date("Y-m-d")==date("Y-m-01")){echo date("Y-m-02");}else{echo date("Y-m-d");}?>" id="materials-stock-orders-date_to">
                <button type="button" class="btn btn-primary" id="btn-materials-stock-orders" onclick="getMaterialsStockOrdersReports();">
                    Применить
                </button>
            </div>
            <div class="panel-body" id="materials-stock-orders-div">

            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="materials_stock">
        <div class="panel panel-default">
            <div class="panel-heading form-inline">
                <!--<div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-send="" data-backdrop="static" data-id="0" onclick="getMaterialsStockOrder(1)" id="btn-newordermaterials">
                        <span class="glyphicon glyphicon-file"></span> Новый заказ материалов
                    </button>
                </div>
                <div class="form-group">
                    <label for="orders-materials">Заказы материалов:</label>
                    <select id="orders-materials">

                    </select>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWindow" data-backdrop="static" onclick="getMaterialsStockOrder()" id="btn-openordermaterials">
                        <span class="glyphicon glyphicon-file"></span> Открыть заказ на материал
                    </button>
                </div>-->
            </div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Наименование</td>
                        <td>Цех</td>
                        <td>Кол.</td>
                    </tr>
                    </thead>
                    <tbody id="tbody-materials_stock"></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
