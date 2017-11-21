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