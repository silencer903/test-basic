function JsFunc(){
    var test=$("#testing").val(); // Наделение переменной значением из input'a
    var formData = new FormData($("#order")[0]);
    $.ajax({
        type: "POST",
        url: "http://test:8080/basic/web/index.php?r=input%2Freturn",
        cache: false,
        headers: { 'cache-control': 'no-cache' },
        contentType: false,
        processData: false,
        dataType: 'html',
        data: formData,
        success: function (msg) {
            console.log(JSON.parse(msg));
            var json = JSON.parse(msg);
            $('#result-order').text(json['id_order']);
            $('#result-fio').text(json['fio']);
        }
    })
}

function JsGet() {
    var idorder=$("#testing").val();
    $.ajax({
        type: 'POST',
        url: 'http://test:8080/basic/web/index.php?r=input%2Fgetorders',
        data:'id_order='+idorder,
        success: function (get){
            $("#tbody-orders").html(get);
        }
    })
}

function JsSave() {
    var formData = new FormData($("#order")[0]);
    $.ajax({
        type: 'POST',
        url: 'http://test:8080/basic/web/index.php?r=input%2Fsaveorupdateorders',
        cache: false,
        headers: { 'cache-control': 'no-cache' },
        contentType: false,
        processData: false,
        dataType: 'html',
        data: formData,
        success: function (save){
          JsGet()
        }
    })
}