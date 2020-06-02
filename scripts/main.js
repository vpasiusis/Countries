$(window).ready(function (){
    
    // Datos ir laiko įskiepių nustatymas
    $.datetimepicker.setLocale('lt');
    $('.datetime').datetimepicker({
        format: 'Y-m-d H:i',
        dayOfWeekStart : 1,
        startDate: '2016-01-01',
        defaultDate: '2016-01-01'
    });
    
    $('.date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        defaultDate: '2016-01-01'
    });
});

function success() {
    if(document.getElementById("search").value==="") {
        document.getElementById('searchButton').disabled = true;
    } else {
        document.getElementById('searchButton').disabled = false;
    }
}
function searchReplace(module) {
    var text = document.getElementById("search").value;
    window.location.replace("index.php?module=" + module + "&action=list&text=" + text);

}
function searchReplaceCity(module,countryId) {
    var text = document.getElementById("search").value;
    window.location.replace("index.php?module=" + module + "&action=list&cid="+countryId+"&text=" + text);

}