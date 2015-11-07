// Add new field for description loading
function addField() {
    var afterField =  jQuery('.countField');
    var countField = jQuery('.countField td input').val();
    jQuery('.fieldName').remove();
    for (var i = +countField+1; i > 1; i--) {
        afterField.after("<tr class='fieldName'><td>Поле #"+(i-1)+":</td><td>  <input type='text' placeholder='имя поля' name='field[]'>" +
            "<input type='number' placeholder='номер столбца в листе MS Excel' name='number[]' min = 1 max = 8></td></tr>");
    }
}
// Add path file for JSON file
function setPathFile() {
    var needFile = jQuery('#setFile');
    if (needFile.is(':checked')) {
        jQuery('.path').show();
    } else {
        jQuery('.path').hide();
    }
}
// Add table's name  for load data
function setTableName() {
    var needBD = jQuery('#setBD');
    if (needBD.is(':checked')) {
        jQuery('.bd').show();
    } else {
        jQuery('.bd').hide();
    }
}


