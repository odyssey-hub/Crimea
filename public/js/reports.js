$(".list-group-item").click(function() {
    $(".list-group-item").removeClass('active');
    $(this).toggleClass('active');
})

$(".block-list-reports").click(function(event) {
    // console.log($(event.target).data('id'));
    if ($(event.target).data('id')) {
        var urlDownload = $("#download-file").attr("href");
        var urlEdit = $("#edit-file").attr("href");
        var urlDestroy = $("#destroy-file").attr("action");
        var lastPosDownload = urlDownload.lastIndexOf("/");
        var lastPosEdit = urlEdit.lastIndexOf("/");
        var lastPosDestroy = urlDestroy.lastIndexOf("/");
        // console.log(urlDownload);
        // console.log(urlDestroy);
        $("#download-file").attr("href", urlDownload.substring(0, lastPosDownload + 1) + $(event.target).data('id'));
        $("#edit-file").attr("href", urlEdit.substring(0, lastPosEdit + 1) + $(event.target).data('id'));
        $("#destroy-file").attr("action", urlDestroy.substring(0, lastPosDestroy + 1) + $(event.target).data('id'));
    }
})