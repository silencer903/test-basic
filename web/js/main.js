function AjaxFormRequest(form_data,url,tag_update,noHide) {
    try
    {
        if(!noHide){
            //$(tag_update).html('');
        }
        form_data.append("_csrf",$('meta[name="csrf-token"]').attr("content"));
        //form_data.append("id_stores",$('#w0').attr("data-id-stores"));
        //console.log($('meta[name="csrf-token"]').attr("content"));
        //console.log(form_data.append("_csrf",$('meta[name="csrf-token"]').attr("content")));
        if(tag_update!='#modalWindow'){
            $("#loader").show();
        }else{
            $(tag_update).html('');
        }
        if(tag_update.indexOf("tbody")>-1){//style="display:flex;justify-content:center;align-items:center;
            //$(tag_update).html('<tr><td class="loader" colspan="13"></td></tr>');
            //$("body").append('<div class="loader" style="display:flex;justify-content:center;align-items:center; width: 100%;height: 100%></div>');
        }
        return $.ajax({
            url:  url,
            type: 'POST',
            cache: false,
            headers: { 'cache-control': 'no-cache' },
            contentType: false,
            processData: false,
            dataType: 'html',
            //scriptCharset: "utf-8",
            data: form_data,
            success: function(response) {


                /*if(response=='ok')
                 {
                 show_success();
                 if(!noHide)
                 {
                 $('#modalWindow').modal('hide');
                 }
                 }else{
                 if(tag_update=='')
                 {
                 show_success();
                 if(!noHide)
                 {
                 $('#modalWindow').modal('hide');
                 }
                 }else{
                 $(tag_update).html(response);
                 }
                 }*/
                if(tag_update=='')
                {
                    if(response=='ok')
                    {
                        show_success();
                        if(!noHide)
                        {
                            $('#modalWindow').modal('hide');
                        }
                    }
                }else{
                    $(tag_update).html(response);
                }
                $("#loader").hide();
                //console.log(response);
                /*if(response == 'ok'){
                 show_success(win_modal);
                 if(func_upd){func_upd(1)};
                 }else{
                 show_error(response);
                 }*/
            },
            error: function(jqXHR, textStatus, errorThrown) { //Если ошибка
                //alert(textStatus);
                //throw new Error('Ошибка при отправке формы'+errorThrown);
                var textError=jqXHR.responseText;
                console.log(textError);

                if(textError.indexOf("UserError")>-1){
                    var errorString = textError.substring(textError.indexOf(":",textError.indexOf("UserError"))+1);
                    show_error(errorString);
                    $('#btn-save-OrderModal').prop('disabled', false);
                }else{
                    show_error('Ошибка при отправке формы');
                }
                $("#loader").hide();
            }
        });
    }catch(e){
        show_error(e.message);
    }

}

function getStockModal(){
    var formData = new FormData();

    $.when(AjaxFormRequest(formData,'inventory/getstockmodal','#modalWindow')).done(function()
    {

    });
}

function addProductStockModal(operation){
    var formData = new FormData();
    formData.append('operation',operation);
    formData.append('count_products',$("#stock-products tr").length);
    formData.append('article',$("#article-stockProducts").val());
    $.when(AjaxFormRequest(formData,'inventory/addproductstockmodal','')).done(function(response)
    {
        $("#stock-products").append(response);
    });
}

function saveProductsStockModal(){
    var formData = new FormData($("#frm-stockProducts")[0]);
    $.when(AjaxFormRequest(formData,'inventory/saveproductsstockmodal','')).done(function()
    {
        $("#stock-products").html('');
    });
}

function getClothStockModal(){
    var formData = new FormData();
    $.when(AjaxFormRequest(formData,'cloth/getclothstockmodal','#modalWindow')).done(function()
    {
        // $('#modalWindow').modal('hide');
    });
}

function addClothStockModal(operation){
    var formData = new FormData();
    formData.append('operation',operation);
    formData.append('article',$("#article-clothStockProducts").val());
    formData.append('count_cloth',$("#tbody-cloth-stock tr").length);
    $.when(AjaxFormRequest(formData,'cloth/addclothstock','')).done(function(response)
    {
        console.log(response);
        $("#tbody-cloth-stock").append(response);
    });
}

function saveClothStockModal(){
    var formData = new FormData($("#frm-clothStockProducts")[0]);
    $.when(AjaxFormRequest(formData,'cloth/saveclothstock','')).done(function(response)
    {

    });
}

function hideDropDown()
{
    $("#clients-list").hide();
}

function show_error(txt){
    $("#main-error").html(txt).show().delay(6000).fadeOut(400);
}
function show_success(win,nohide){
    $("#main-error").hide();
    $("#main-success").html('Команда выполнена успешно').show().delay(1000).fadeOut(400);
    if(!nohide){$("#"+win).modal('hide');}
}

//Выделяет Текстовый скрипт
function SelectText(element) {
    var scriptText = element;
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
        ;
    console.log(text);
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
        var successful = document.execCommand('copy');
        //var msg = successful ? 'successful' : 'unsuccessful';
        var msg='';
        if(successful){
            msg='successful';
            var formData = new FormData();
            if(scriptText=="div-txtScript-OrderModal"){
            //увеличение конверсии продавца
                $.when(AjaxFormRequest(formData,'request/conversionupforseller','')).done(function()
                 {

                 });
            }else{
                //увеличение конврсии скрипта из списка скриптов
                var scriptId=scriptText.substring(scriptText.indexOf("-")+1);
                formData.append("scriptId",scriptId);
                /*$.when(AjaxFormRequest(formData,'scripts/conversionupforscript','')).done(function()
                {

                });*/
            }
        }else{
            msg='unsuccessful';
        }
        console.log('Copy command was ' + msg);
    }
}


function asking(text){

}

function switchVkAccount(){
    var formData = new FormData();
    formData.append('idVkAccounts',0);
    $.when(AjaxFormRequest(formData,'site/updateuservk','')).done(function(response)
    {
        document.location.href="site/changevk";
    });
}
function changeVkAccount(){
    //var id=$(obj).data("id");
    var formData = new FormData($("#vkaccounts-form")[0]);
    //formData.append('idVkAccounts',id);
    $.when(AjaxFormRequest(formData,'updateuservk','')).done(function()
    {
        document.location.href="../orders";
    });
}

function changeStore(idStore){
    var formData = new FormData();
    $("#w0").attr('data-id-stores',idStore);
    formData.append('id_stores',idStore);
    $.when(AjaxFormRequest(formData,'site/changestore','')).done(function(response)
    {
        location.reload();
    });
}

function checkMaterial(){
    var formData = new FormData();
    if($("[id^=name_materials_input]").val()!=''){
        formData.append('name',$("[id^=name_materials_input]").val());
        $.when(AjaxFormRequest(formData,'materialsstock/findmaterial','#materials-list')).done(function()
        {
            $("#materials-list").show();
        });
    }else{
        $("#materials-list").hide();
    }

}

function checkClient() {
    var formData = new FormData();
    if($("[id^=name_clients_input]").val()!=''){
        formData.append('name_clients',$("[id^=name_clients_input]").val());
        $.when(AjaxFormRequest(formData,'clients/findclient','#clients-list')).done(function()
        {
            $("#clients-list").show();
        });
    }else{
        $("#clients-list").hide();
    }
}

function getClientAdd(obj) {
    $("[id^=name_clients_input]").val($(obj).text());
    $("#clients-list").hide();
}

function getMaterialAdd(obj) {
    $("[id^=name_materials_input]").val($(obj).text());
    $("#materials-list").hide();
}

function checkProduct(obj){
    var formData = new FormData();
    if($(obj).val()!=''){
        formData.append('name_products',$(obj).val());
        $.when(AjaxFormRequest(formData,'products/findproduct',"#"+$(obj).attr("data-for"))).done(function()
        {
            $("#"+$(obj).attr("data-for")).show();
        });
    }else{
        $("#"+$(obj).attr("data-for")).hide();
    }

}

function checkFactoryStockProducts(){
    var formData = new FormData();
    if($("[id^=name_factory_stock_products_input]").val()!=''){
        formData.append('name_factory_stocks_products',$("[id^=name_factory_stock_products_input]").val());
        $.when(AjaxFormRequest(formData,'factoryworkprocess/findfactorystockproducts','#factory_stock_products-list')).done(function()
        {
            $("#factory_stock_products-list").show();
        });
    }else{
        $("#factory_stock_products-list").hide();
    }

}

function getProductAdd(obj) {
    console.log($(obj).closest("div").attr("data-for"));
    $("#"+$(obj).closest("div").attr("data-for")).val($(obj).text());
    $(obj).closest("div").hide();
}

function getFactoryStocksProductAdd(obj) {
    $("[id^=name_factory_stock_products_input]").val($(obj).text());
    $("#factory_stock_products-list").hide();
}

$(document).ready(function(){
    $(".post_data_link").fancybox({
        'type' : 'ajax'
    });
    $(".single_image").fancybox();
    /*$("#yii-debug-toolbar").hide();
    $("#yii-debug-toolbar-min").hide();*/
    $("#find-main").keypress(function(e){
        if(e.keyCode==13){
            var find = $(this).val();
            var formData = new FormData();
            formData.append('article',find);
            if(find.match(/\d+/)){
                if(find.indexOf("http")!=-1){
                    window.open("clients/getclient?vk="+find);
                }else{
                    $.when(AjaxFormRequest(formData,'products/getproductbyarticle','')).done(function(response)
                    {
                        var product=JSON.parse(response);
                        var titleText=product['article'] + ' - ' + product['name'] + '. Цена: '+product['price']+' '+product['material'];
                        if(product['sizes']){
                            titleText+=" Размеры:"+product['sizes'];
                        }
                        $.fancybox( {helpers     : {
                        },href : "http://vestidofashionnew.ru/selfie/web/products_img/"+product['article']+"."+product['img'] ,title:titleText} );
                    });
                }
            }else{
                window.open("clients/getclient?fio="+find);
            }

        }
    });

});