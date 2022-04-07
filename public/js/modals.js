(function () {
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    var modal_form = new bootstrap.Modal(document.getElementById('modal_form'), {
        keyboard: false
    })

    var modal_delete = new bootstrap.Modal(document.getElementById('modal_delete'), {
        keyboard: false
    })

    var myOffcanvas = document.getElementById('offcanvasRoute');
    var offcanvasRoute = new bootstrap.Offcanvas(myOffcanvas);

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    });


    function isFormValidate() {
        var wasValid = true;
        $(".invalid-feedback").each(function () {
            if ($(this).css("display") != "none") wasValid = false;
        })
        return wasValid;
    }

    function addRoute(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var route_name = $("#route_name").val();
        var route_desc  = $("#route_desc").val();
        var route_obj = $("#route_objs").val();
        var route_cost = $("#route_cost").val();
        var route_time = $("#route_time").val();
        var route_gid = $("#route_gid").val();
        $.ajax({
            url: '/routes_admin/add',
            type: "POST",
            data: {
                name:route_name,
                description:route_desc,
                duration:route_time,
                cost:route_cost,
                attractions:route_obj,
                gid:route_gid
            },
            success: function (id) {
                var html_text = ` <div class="card" data-route-id="${id}">
                    <h5 class="card-header">
                        ${route_name}
                    </h5>
                    <div class="card-body bg-light">
                        <p class="card-text">${route_obj}</p>
                        <div class="card-funcs">
                            <button type="button" class="btn btn-primary btnShowRouteInfo" data-name="${route_name}"
                                    data-gid="${route_gid}" data-objects="${route_obj}"
                                    data-time="${route_time}" data-desc="${route_desc}"
                                    data-cost="${route_cost}">Подробнее
                            </button>
                            <i class="bi bi-pencil-square"  data-route-id="${id}"></i>
                        </div>

                    </div>
                </div>`;

                $(".cards").append(html_text);
                var this_card = $(".card[data-route-id="+id+"]");
                this_card.find('.btnShowRouteInfo').click(function (){
                    EventShowInfo($(this));
                });
                this_card.find('.bi-pencil-square').click(function(){
                    EventEditInfo($(this));
                    editId = $(this)[0].dataset.routeId;
                });

                // this_card.find(".card-header").click(function(){
                //     $(".card-header").each(function(){
                //         $(this).removeClass("card-active");
                //     })
                //     $(this).addClass("card-active");
                // })
                modal_form.hide();
                toastList[0].show();
                $('#formAddRoute')[0].reset();
                $('#formAddRoute').removeClass("was-validated");
            },
            error: function (msg) {
                console.log(msg.responseText);
                alert('Ошибка:'+msg.responseText);
            }
        });
    }

    function deleteRoute(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/routes_admin/delete',
            type: "POST",
            data: {
                id:id
            },
            success: function (data) {
                var card = $(".card[data-route-id="+id+"]")[0];
                card.remove();
                modal_delete.hide();
                toastList[1].show();
            },
            error: function (msg) {
                alert('Ошибка:'+msg.responseText);
            }
        });
    }

    function editRouteInfo(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var route_name = $("#route_name").val();
        var route_desc  = $("#route_desc").val();
        var route_obj = $("#route_objs").val();
        var route_cost = $("#route_cost").val();
        var route_time = $("#route_time").val();
        var route_gid = $("#route_gid").val();

        $.ajax({
            url: '/routes_admin/editInfo',
            type: "POST",
            data: {
                id:id,
                name:route_name,
                description:route_desc,
                duration:route_time,
                cost:route_cost,
                attractions:route_obj,
                gid:route_gid
            },
            success: function (data) {
                var card = $(".card[data-route-id="+id+"]");
                card.find(".card-header").text(route_name);
                card.find(".card-text").text(route_obj);
                var btn = card.find(".btnShowRouteInfo")[0];
                btn.dataset.name = route_name;
                btn.dataset.gid = route_gid;
                btn.dataset.objects = route_obj;
                btn.dataset.desc = route_desc;
                btn.dataset.cost = route_cost;
                btn.dataset.time = `${route_time[0]}${route_time[1]} часов ${route_time[3]}${route_time[4]} минут`;
                $('#formAddRoute')[0].reset();
                $('#formAddRoute').removeClass("was-validated");
                modal_form.hide();
            },
            error: function (msg) {
                alert('Ошибка:');
            }
        });
    }

    $("#formAddRoute").submit(function(e){
        e.preventDefault();
        if (isFormValidate() && $("#modal_form .modal-title").text() === "Добавление маршрута")
            addRoute();
        if (isFormValidate() && $("#modal_form .modal-title").text() === "Редактирование маршрута")
            editRouteInfo(editId);
    })



    $("#btnAddRoute").click(function(){
        $("#modal_form .modal-title").text("Добавление маршрута");
    })




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




    function EventEditInfo(el){
        console.log(el[0].dataset.routeId);
        $('#formAddRoute').removeClass("was-validated");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/routes_admin/getData',
            method: 'get',
            dataType: 'json',
            data: {
              id:  el[0].dataset.routeId
            },
            success: function(data){
                $("#route_name").val(data.name);
                $("#route_desc").val(data.description);
                $("#route_objs").val(data.attractions);
                $("#route_cost").val(data.cost);
                $("#route_time").val(data.duration);
                $("#route_gid").val(data.gid);
                modal_form.show();
                $("#modal_form .modal-title").text("Редактирование маршрута");

            },
            error: function (msg) {
                alert(msg.responseText);
                console.log(msg.responseText);
            }
        });
    }

    $(".btnShowRouteInfo").click(function(){
        EventShowInfo($(this));
    })


    var editId = 5;
    $(".bi-pencil-square").click(function(){
        EventEditInfo($(this));
        editId = $(this)[0].dataset.routeId;
    })

    $("#modalBtnDelConfirm").click(function () {
        var id = $(".card-active").parent()[0].dataset.routeId;
        if (id == null) return;
        deleteRoute(id);
    })


    $("#modalBtnCancel").click(function () {
        if ($("#modal_form .modal-title").text() === "Редактирование маршрута"){
            $('#formAddRoute')[0].reset();
        }
    })


})()
