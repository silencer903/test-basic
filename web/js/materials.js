/**
 * Created by Silencer on 18.11.2017.
 */

function getMaterials() {
    var formData = new FormData();
    $.when(AjaxFormRequest(formData, 'materialsstock/getmaterials', '#tbody-materials')).done(function () {

    });
}

$(document).ready(function(){
    getMaterials();

});