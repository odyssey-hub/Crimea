document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var dateBegin;
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dateClick: function (info) {
            // info.dayEl.style.backgroundColor = 'red';
            dateBegin = info.dateStr;
            $("#windowModalCenter").modal("show");
        },
        eventClick: function(info) {
            $("#form-edit").attr("action", "/calendar/update/" + info.event.id);
            $("#form-delete").attr("action", "/calendar/destroy/" + info.event.id);
            $("#delete-event").attr("data-id", info.event.id);

            $.ajax({
                type: 'POST',
                url: "/calendar/edit/" + info.event.id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                data: {id: info.event.id},
                success: function(data){
                    $("#title-edit").attr("value", data.title);
                    $("#description-edit").text(data.description);
                    $("#date-begin-edit").attr("value", data.start);
                    $("#date-end-edit").attr("value", data.end);
                }
            });

            $("#windowModalCenter2").modal("show");
        },
        locale: 'ru',
        firstDay: 1,
        buttonText: {
            today: "Сегодня",
            month: "Месяц",
            week: "Неделя",
            day: "День"
        },
        eventSources: [
            {
                events: events
            }
        ]
    });
    calendar.render();

    function close_modal() {
        $(".modal").modal("hide");
        $("#title").val("");
        $("#description").val("");
        $("#date-end").val("");
    }

    $(".btn-secondary").click(function (event) {
        close_modal();
    })

    $("#add-event").click(function (event) {
        event.preventDefault();
        
        var title = $("#title").val();
        var description = $("#description").val();
        var dateEnd = $("#date-end").val();
        dateEnd = new Date(dateEnd);
        dateEnd.setDate(dateEnd.getDate() + 1);

        const dateSrc = dateEnd.toLocaleString('ru-RU', { year: 'numeric', month: 'numeric', day: 'numeric' });
        dateEnd = dateSrc.split(".").reverse().join("-");

        $.ajax({
            type: 'POST',
            url: "/calendar",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {title: title, description: description, dateBegin: dateBegin, dateEnd: dateEnd},
            success: function(){
                calendar.addEvent({
                    title: title,
                    start: dateBegin,
                    end: dateEnd
                })
            }
        });
        close_modal();
    })

    // $("#delete-event").click(function (event) {
    //     event.preventDefault();
    //     $("#windowModalCenter2").modal("hide");

    //     var id = $("#delete-event").attr("data-id");

    //     $.ajax({
    //         type: 'POST',
    //         url: "/calendar/destroy/" + id,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {id: id},
    //         success: function(data){
    //             // calendar.getEventById(id).remove();
    //             console.log("Удача" + data)
    //         }
    //     });
    // })
});