<?php
/**
 * Created by PhpStorm.
 * User: Silencer
 * Date: 18.01.2016
 * Time: 19:49
 */
/* @var $orders array */
if($orders){
    $rows='';
    foreach($orders as $order){
        $rows.='<tr>';
        $rows.='<td>'.$order['id_orders'].'</td>';
        $rows.='<td>'.$order['fio'].'</td>';
        $rows.='</tr>';
    }
    echo $rows;
}else{
    echo '<tr><td class="hint-lg" colspan="5">Данные отсутсвуют</td></tr>';
}