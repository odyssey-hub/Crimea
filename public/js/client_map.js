$(function () {
    var myOffcanvas = document.getElementById('offcanvasRoute');
    var offcanvasRoute = new bootstrap.Offcanvas(myOffcanvas);

    function EventShowInfo(el){
        var textRouteName =  el.data("name");
        var textRouteDesc =  el.data("desc");
        var textRouteObjects =  el.data("objects");
        var textRouteTime = el.data("time");
        var textRouteCost = el.data("cost");
        var textRouteGid = el.data("gid");
        $("#textRouteName").text(textRouteName);
        $("#textRouteDesc").text(textRouteDesc);
        $("#textRouteObjects").text(textRouteObjects);
        $("#textRouteTime").text(textRouteTime);
        $("#textRouteCost").text(textRouteCost);
        $("#textRouteGid").text(textRouteGid);
        offcanvasRoute.show();
    }

    $(".btnShowRouteInfo").click(function(){
        EventShowInfo($(this));
    })
})



var myMap;

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init () {
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        referencePoints: []
    }, {
        // Тип промежуточных точек, которые могут быть добавлены при редактировании.
        editorMidPointsType: "via",
        // В режиме добавления новых путевых точек запрещаем ставить точки поверх объектов карты.
        editorDrawOver: true
    });

    myMap = new ymaps.Map('map', {
        center: [45.389196, 33.993638], // Крым
        zoom: 7,
        controls: ['zoomControl', 'typeSelector']
    }, {
        buttonMaxWidth: 300,
        restrictMapArea: [
            [46.292204, 31.869077],
            [43.744804, 37.488584]
        ]
    });


    function EventPath(el){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = el.parent()[0].dataset.routeId;
        console.log(id);
        $.ajax({
            url: '/routes_admin/getPath',
            method: 'get',
            dataType: 'json',
            data: {
                id:id,
            },
            success: function (data) {
                var json_refs = data;
                myMap.geoObjects.remove(multiRoute);
                multiRoute = new ymaps.multiRouter.MultiRoute({
                    referencePoints: json_refs
                }, {
                    // Тип промежуточных точек, которые могут быть добавлены при редактировании.
                    editorMidPointsType: "via",
                    // В режиме добавления новых путевых точек запрещаем ставить точки поверх объектов карты.
                    editorDrawOver: true
                });
                multiRoute.options.set('routeVisible', false);
                multiRoute.options.set('routeActiveVisible', true);
                myMap.geoObjects.add(multiRoute);
            },
            error: function (msg) {
                myMap.geoObjects.remove(multiRoute);
            }
        });
    }


    $("body").on("click",".card-header", function() {
        $(".card-header").each(function () {
            $(this).removeClass("card-active");
        })
        $(this).addClass("card-active");
        EventPath($(this))
    })




    var searchControl = new ymaps.control.SearchControl({
        options: {
            width: 500,
            noPopup: true,
            provider: 'yandex#search'
        }
    });

    myMap.controls.add(searchControl);
    searchControl.search('Достопримечательности крыма');

}
