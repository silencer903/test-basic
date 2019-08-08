<?php
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/inputjs.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<form role="form" class="form-horizontal" id="order" enctype="multipart/form-data" method="POST">
<div class="form-group">
	<label for="input-sizes-ProductsModal" class="col-sm-2 control-label">№ заказа</label>
		<div class="col-sm-4">
			<input type="text" name="order[id_order]" id="testing" class="form-control" value="">
		</div>
</div>
    <div class="form-group">
        <label for="input-sizes-ProductsModal" class="col-sm-2 control-label">ФИО</label>
        <div class="col-sm-4">
            <input type="text" name="order[fio]" id="testing-2" class="form-control" value="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button type="button" class="btn btn-default" onclick="JsGet()">Найти</button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button type="button" class="btn btn-default" onclick="JsSave()">Сохранить</button>
        </div>
    </div>
</form>
<form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№ Заказа</th>
            <th>ФИО</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbody-orders">
        <tr><td>356</td><td>Test</td></tr>
        </tbody>
    </table>
</form>
