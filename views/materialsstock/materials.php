<?php
/**
 * Created by PhpStorm.
 * User: Silencer
 * Date: 18.11.2017
 * Time: 16:30
 */

/* @var $materials array*/
/* @var $measures array*/

if($materials){
    $rows='';
    foreach ($materials as $material){
        if($material['color']==1){
            $material['name'].=' (Цвет)';
        }
        $rows.='<tr>';
        $rows.='<td>'.$material['name'].'</td>';
        $rows.='<td>'.$material['measure'].'</td>';
        $rows.='<td>'.$material['materials_factory_name'].'</td>';
        $rows.='<td>'.$material['name_materials_suppliers'].'</td>';
        $rows.='<td>'.$material['cost_price_materials'].'</td>';
        $rows.='<td><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalWindow" data-send="" data-id="'.$material['id_materials'].'" data-backdrop="static" onclick="getMaterial(this)"><span class="glyphicon glyphicon-pencil"></span></button></td>';
	    $rows.='<td><button type="button" class="btn btn-default btn-xs" data-id_materials="'.$material['id_materials'].'" onclick="deleteMaterial(this)"><span class="glyphicon glyphicon-remove"></span></button></td>';
        $rows.='</tr>';
    }
    echo $rows;
}
