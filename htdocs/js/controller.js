var Controller = {
    page: 0,
    tab:0,
    class_name:'',
    obj_name:'',
    name:'',
    manager:{},
    doctor:{},
    patient:{},
    visit:{},
    call:{},
    payment:{},
    reminder:{},
    repmanager:{},
    repdoctor:{},
    reppatient:{},
    admin:{},
    files:'',

    click: function () {
        var id = $(this).attr("id");
        //  action : class + function + id

        var action = id.split('-');

        Controller.class_name = Controller[action[0]].name;
        Controller.obj_name = action[0];

        if (typeof action[2] !== 'undefined') {             // if param is exists

            var param = {"id": action[2]};
        }

        Controller[action[0]].data = {"class" : 'View' + Controller.class_name, "method" : action[1], "param" : param };

        Controller[action[0]][action[1]]();

    },

    select: function () {
        var id = $(this).attr("id");
        //  action : namespace + function + id
        var action = id.split('-');

        window[ action[0] ][ action[1] ]( action[2] );

    },

    page: function () {

            Controller.page = $('#ShowPage option:selected').val();
            var param = { "page_id":$('#ShowPage option:selected').val(), "page_name":$('#ShowPage option:selected').attr('id') };

            $.ajax({
                type: 'POST',
                async: false,
                url: "ajax.php",
                data: {"class": "ViewPage", "method":'ChangePage', "param":param },     //      json data to send
                dataType: 'json',
                success: function(data){
                    window.location.reload();
                }
            });
    },


    tab: function (event, ui) {

        var tab = ui.newTab.index();
        Controller.runTab(tab);

    },



    runTab: function (tab) {

        Controller.tab = tab;
        var param = {"page": Controller.page, "tab": tab};

        $.ajax({
            type: 'POST',
            async: false,
            url: "ajax.php",
            data: {"class": "ModelPage", "method": 'getTabProfile', "param": param},     //      json data to send
            dataType: 'json',
            success:  $.proxy(function(data) {

                if (data['success']) {
                    var obj = data['name'];
                    Controller['obj_name'] = obj;

                    Controller['class_name'] = data['class_name'];
console.log('run tub stfiltr:' + Controller[obj].name);
                    Controller[obj].setFiltr();

                    setTimeout(window[obj + 'Timer'], 1000);

                    Controller[obj].ScrollToRow();

                } else
                    alert(data['msg']);
            }, this)

        });
    },

    refresh: function () {

        var id = $(this).attr("id");
        //  action : class + function + id

        var action = id.split('-');

        Controller.class_name = Controller[action[0]].name;
        Controller.obj_name = action[0];

        var param = { "name" : action[0], "dt" : $('.main-dt').val() };

        Controller[action[0]].data = {"class" : 'View' + Controller.class_name, "method" : action[1], "param" : param };

        Controller[action[0]][action[1]]();

    },

    trClick: function () {

        var id = $(this).attr("id");
     //  alert(id);
        var item = id.split('-');
        var obj = item[0].charAt(0).toLowerCase() + item[0].slice(1);

      //  alert('obj' + obj + ' id' + item[1]);
        Controller[obj].SelectRow(item[1]);

        $(".td_cursor").removeClass("td_cursor");
        $("#" + id + " td").addClass("td_cursor");

        return true;
    },

    loadFiles: function (event) {
        console.log('load files function' + event);

        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        var data = new FormData();
        $.each( Controller.files, function( key, value ){
            console.log('key:' + key + ' value:' + value);
            data.append( key, value );
        });


        $.ajax({
            url: 'upload.php?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){

                // Если все ОК

                if( typeof respond.error === 'undefined' ){
                    // Файлы успешно загружены, делаем что нибудь здесь

                 /*   $.each( respond.files, function( key, val ) {
                            Controller.import1C(val);
                        }
                    );*/

                }
                else{
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });

    }


}