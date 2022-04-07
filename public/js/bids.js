$(function () {
    var count = 0;
    $(".card").each(function () {
        count++;
    })
    var k = 0;

    $(".btnBidDel").click(function () {
        var id = $(this).closest(".card")[0].dataset.id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/bids/delete',
            type: "POST",
            data: {
                id:id
            },
            success: function (data) {
                var card = $(".card[data-id="+id+"]");
                card.hide('slow', function(){ card.remove();k++;});
                if (k==count-1) {
                    location.reload();
                }
            },
            error: function (msg) {
                alert('Ошибка:'+msg.responseText);
            }
        });
    })
})
