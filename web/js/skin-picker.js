$(document).ready(function(){
    $(".champion-skin").on("click", function() {
        var url = $(this).find('.champion-url').val();
        $(".champion-preview").css('background-image', 'url(' + url + ')');
    });
});