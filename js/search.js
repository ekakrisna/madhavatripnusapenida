$(document).ready(function () {
    $("#search_form").submit(function (e) {
        e.preventDefault();
        var q = $("#query_search").val();
        window.location = "paket?q=" + q;
    });
});