$(document).ready(function(){
    $(function(){
        $(".champion-content").on("click", ".champ", function(){
            $("#champsss").append($(this));
            var attr = $("#champion_find_champion_list").attr('value');

            if (typeof attr !== typeof undefined && attr !== false) {
                $("#champion_find_champion_list").attr("value", $("#champion_find_champion_list").attr("value") + $(this).find("#id").text() + ",");
            } else {
                $("#champion_find_champion_list").attr("value", $(this).find("#id").text() + ",");
            }
        });
    });

    $(function(){
        $("#champsss").on("click", ".champ", function(){
            $(".champion-history").append($(this));

            var attr = $("#champion_find_champion_list").attr('value');

            if (typeof attr !== typeof undefined && attr !== false) {
                $("#champion_find_champion_list").val($("#champion_find_champion_list").val().replace($(this).find("#id").text() + ",", ""));
            } else {
                //$("#champion_find_champion_list").removeAttr("value");
                //$("#champion_find_champion_list").val($("#champion_find_champion_list").val().replace($(this).find("#id").text(), ""));
            }
        });
    });
});

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$(document).on('input', '.discount_credits', function() {
    $('.credits').html( addCommas($('.discount_credits').val()) );
});