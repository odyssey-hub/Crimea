var toastList;
$(function () {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    });
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

    var buttonEditor = new ymaps.control.Button({
        data: { content: "Режим редактирования" }
    });

    var buttonSave = new ymaps.control.Button({
        data: { content: "Сохранить" },
        options: {  selectOnClick: false}
    });

    var buttonClear =  new ymaps.control.Button({
        data:{ content: "Очистить"},
        options: {  selectOnClick: false}
    })

    var zoomControl = new ymaps.control.ZoomControl();

    myMap = new ymaps.Map('map', {
        center: [45.389196, 33.993638], // Крым
        zoom: 7,
        controls: [zoomControl, 'typeSelector', buttonEditor]
    }, {
        buttonMaxWidth: 300,
        restrictMapArea: [
            [46.292204, 31.869077],
            [43.744804, 37.488584]
        ]
    });

    buttonEditor.events.add("select", function () {
        myMap.controls.remove(zoomControl);
        myMap.controls.add(buttonSave,{float: 'left'});
        myMap.controls.add(buttonClear,{float: 'right'});
        multiRoute.editor.start({
            addWayPoints: true,
            removeWayPoints: true,
            removeViaPoints: true
        });
    });

    buttonEditor.events.add("deselect", function () {
        // Выключение режима редактирования.
        myMap.controls.add(zoomControl);
        myMap.controls.remove(buttonSave);
        myMap.controls.remove(buttonClear);
        multiRoute.editor.stop();
    });

    buttonClear.events.add(("click"),function(){
        multiRoute.model.setReferencePoints([]);
    });

    buttonSave.events.add(("click"),function(){
        var id = $(".card-active").parent()[0].dataset.routeId;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ref_points = multiRoute.model.getReferencePoints();
        var string_refs = JSON.stringify(multiRoute.model.getReferencePoints());
        $.ajax({
            url: '/routes_admin/savePath',
            type: "POST",
            data: {
                id:id,
                points:string_refs
            },
            success: function () {
                toastList[2].show();
            },
            error: function (msg) {
                console.log(msg.responseText);
                alert('Ошибка:'+msg.responseText);
            }
        });
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



    // Добавляем мультимаршрут на карту.
    // myMap.geoObjects.add(multiRoute);




}
