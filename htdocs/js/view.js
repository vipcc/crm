
 function setWindowSize() {


     wHeight = $(window).height();
     wWidth = $(window).width();

     $(".div-table-data").height(wHeight-178);
     // alert(wHeight);

}

//################################################################################################
  function ViewItem () {
     this.id = 0;
     this.name = '';
     this.total = 0;
     this.div = '';
     this.scroll_top = 0;
     this.data = {};

     this.btn_add = '';
     this.btn_edit = '';
     this.btn_delete = '';
     this.btn_confirm = '';

  }

  ViewItem.prototype.showMainTable = function () {

      $.ajax({
          type: 'POST',
          async: false,
          url: "ajax.php",
          data: this.data,          // classname, method, param {name}
          dataType: 'json',
          success: $.proxy(function(data) {

              if(data['success']) {

                  this.div = data['div'];
                  $('#' + data['div']).html(data['html']);
                  this.total = data['total'];
               //   console.log('#' + data['span_total'] + ':' + data['total']);
               //   $('#' + data['span_total']).html(data['total']);
//alert('l');
                  $(".table-data").on("click", 'tr', Controller.trClick);

                  $('#' + data['div']).scrollTop(this.scroll_top);

                  this.btn_add = data['btn_add'];
                  this.btn_edit = data['btn_edit'];
                  this.btn_delete = data['btn_delete'];


                  $('#' + data['btn_add']).hide();
                  $('#' + data['btn_edit']).hide();
                  $('#' + data['btn_delete']).hide();
                  $('.confirm').hide();

                  $(".toolbar").off("change", '.set-filtr');
                  $(".toolbar").on("change", '.set-filtr', this.setFiltr);

                  this.btnStatus(0);
                  // setTimeout(Controller[obj].showMainTable, 2000);
              //    this.setTimer();

              } else
                  alert(data['msg']);
          }, this)

      });

      return true;
  }


 ViewItem.prototype.setTimer = function () {

     var obj = this.name.charAt(0).toLowerCase() + this.name.slice(1);
     var ftimer = window[obj + 'Timer'];
    // alert(ftimer);
     setTimeout(ftimer, 1000);

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewItem.prototype.btnStatus = function (id) {
console.log('btn status');
     var param = { "page" : Controller.page - 1, "tab" : Controller.tab, "id" : id };
     this.data = {"class" : "View" + Controller.class_name, "method" : 'btnStatus', "param" : param };

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,          // classname, method, param {name}
         dataType: 'json',

         success: $.proxy(function(data) {

             if(data['success']) {

                 if(data['btn_add']*1)
                     $('.btn-add').show();
                 else
                     $('.btn-add').hide();

                 if(data['btn_save']*1) {
                     $('.btn-read').hide();
                     $('.btn-edit').show();
                 }
                 else {
                     $('.btn-edit').hide();
                     if(data['id'] > 0)
                        $('.btn-read').show();
                     else
                        $('.btn-read').hide();
                 }


                 if(data['btn_del']*1)
                     $('.btn-delete').show();
                 else
                     $('.btn-delete').hide();

                 if(data['confirm']*1)
                     $('.btn-confirm').show();
                 else
                     $('.btn-confirm').hide();

                 if(data['deconfirm']*1)
                     $('.btn-deconfirm').show();
                 else
                     $('.btn-deconfirm').hide();

             } else
                 alert(data['msg']);
         }, this)

     });

     return 1;
 }

 //-----------------------------------------------------------------------------------------------
 ViewItem.prototype.editStatus = function (id) {

     return 1;
 }


 ViewItem.prototype.SelectRow = function (id) {
//alert('row id:' + id);
     this.id = id;
     this.scroll_top = $('#' + this.div).scrollTop();

     this.btnStatus(id);

     return 1;
  }

  ViewItem.prototype.ScrollToRow = function () {

     if(this.id > 0) {
         console.log("#" + this.name + "-" + this.id + " td");
         $("#" + this.name + "-" + this.id + " td").addClass("td_cursor");
         $('#' + this.div).scrollTop(0);

         var height = $('#' + this.div).height();
         if (height < this.scroll_top)
             $('#' + this.div).scrollTop(this.scroll_top);
     }

     return true;
  }

  ViewItem.prototype.showAddDialog = function () {

      var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name};
      this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Добавить": function() {

                             var dbitem = new window[ 'Db' + Controller.class_name ]();;
                             dbitem.addItem();
                             var obj = Controller.obj_name;
                             Controller[obj]['id'] = dbitem.result['id'];
                             if(dbitem.result['id'] > 0) {
                                 console.log('set filtr after add' + dbitem.result['id']);
                                 Controller[obj]['setFiltr']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                             alert(dbitem.result['msg']);
                         },
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});

             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
  }

//-----------------------------------------------------------------------------------------------
 ViewItem.prototype.showEditDialog = function () {

   //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Сохранить": function() {
                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             dbitem.id = Controller[obj]['id'];
                             dbitem.saveItem();
                             if (dbitem.result['id'] > 0) {
                               //  Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj} };
                                 Controller[obj]['setFiltr']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                         },
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 this.editStatus(this.id);
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewItem.prototype.showReadDialog = function () {

     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;
     this.data['method'] = 'showEditDialog';

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         }
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');

             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewItem.prototype.showDeleteDialog = function () {

     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/delete" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Удалить": function() {

                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             dbitem.param = {"id" : Controller[obj]['id']}
                             dbitem.deleteItem();

                             if (dbitem.result['id'] == 0) {

                               //  Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj} };
                                 Controller[obj]['setFiltr']();

                                 $(this).dialog('destroy').remove();
                             }
                         },
                     },
                     autoOpen: false,
                     width: 300,
                     height: 200,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }


 //##############################################################################################
 //----------------------------------------------------------------------------------------------
 function ViewManager () {
     ViewItem.apply(this, arguments);
     this.name = 'Manager';
     this.data = {"class" : "ViewManager" };
 }

 ViewManager.prototype = Object.create(ViewItem.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewManager.prototype.setFiltr = function () {

     var param = { "name" : "manager",
         "region" : $('#manager_filtr_region option:selected').val(),
         "dt" : $('#manager_filtr_dt').val()
     };

     Controller['manager'].data = {"class" : "ViewManager", "method" : 'showMainTable', "param" : param };
     Controller['manager'].showMainTable();

 }



 //----------------------------------------------------------------------------------------------
 function ViewVisit () {
     ViewItem.apply(this, arguments);
     this.name = 'Visit';
     this.data = {"class" : "ViewVisit" };
 }

 ViewVisit.prototype = Object.create(ViewItem.prototype);

 //-----------------------------------------------------------------------------------------------

 //-----------------------------------------------------------------------------------------------
 ViewVisit.prototype.confirm = function () {

     var dbitem = new window['DbVisit']();

     dbitem.confirm();
     console.log('view config - ' + dbitem.result['id']);

         Controller['visit']['setFiltr']();
         Controller['visit']['SelectRow'](this.id);
         Controller['visit']['ScrollToRow']();

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewVisit.prototype.deconfirm = function () {

     var dbitem = new window['DbVisit']();

     dbitem.deconfirm();

         Controller['visit']['setFiltr']();
         Controller['visit']['SelectRow'](this.id);
         Controller['visit']['ScrollToRow']();

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewVisit.prototype.setFiltr = function () {


     var param = { "name" : "visit",
            "manager" : $('#visit_filtr_manager option:selected').val(),
            "dt" : $('#visit_filtr_dt').val()
     };


     Controller['visit'].data = {"class" : "ViewVisit", "method" : 'showMainTable', "param" : param };

     Controller['visit'].showMainTable();

 }

 //-----------------------------------------------------------------------------------------------
 ViewVisit.prototype.showEditDialog = function () {

     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },

                         "Сохранить": function() {
                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             dbitem.id = Controller[obj]['id'];
                             dbitem.saveItem();
                             if (dbitem.result['id'] > 0) {
                             //    Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj} };
                             //    Controller[obj]['showMainTable']();
                                 Controller[obj]['setFiltr']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                         },
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 this.editStatus(this.id);
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }


 //----------------------------------------------------------------------------------------------
 function ViewCall () {
     ViewItem.apply(this, arguments);
     this.name = 'Call';
     this.data = {"class" : "ViewCall" };
 }

 ViewCall.prototype = Object.create(ViewItem.prototype);

 ViewCall.prototype.SelectRow = function (id) {

     if(id*1) {
         this.id = id;
         this.scroll_top = $('#' + this.div).scrollTop();

         $('#' + this.btn_edit).show();
         $('#' + this.btn_delete).show();

     }
     else
         $('#' + this.btn_edit).hide();



     return 1;
 }

 //-----------------------------------------------------------------------------------------------
 ViewCall.prototype.setFiltr = function () {


     var param = { "name" : "call",
         "operator" : $('#call_filtr_operator option:selected').val(),
         "dt" : $('#call_filtr_dt').val()
     };

     Controller['call'].data = {"class" : "ViewCall", "method" : 'showMainTable', "param" : param };
     Controller['call'].showMainTable();

 }
 //-----------------------------------------------------------------------------------------------
 ViewCall.prototype.showEditDialog = function () {

     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Сохранить": function() {
                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             dbitem.id = Controller[obj]['id'];
                             dbitem.saveItem();
                             if (dbitem.result['id'] > 0) {
                                 Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj} };
                                 Controller[obj]['showMainTable']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                         },

                     },
                     autoOpen: false,
                     width: 550,
                     height: 400,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');

                 $( "#edit_patient_name" ).autocomplete({
                     source: "search_patient.php",
                     minLength: 2,
                     select: function( event, ui ) {
                         var doctor_id = ui.item.doctor;
                         $('#edit_patient_name').attr('value',ui.item.value);
                         $("#edit_doctor option[value='" + doctor_id + "']").prop('selected', true);
                     }
                 });

                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }


 //----------------------------------------------------------------------------------------------
 function ViewPayment () {
     ViewVisit.apply(this, arguments);
     this.name = 'Payment';
     this.data = {"class" : "ViewPayment" };
 }

 ViewPayment.prototype = Object.create(ViewVisit.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewPayment.prototype.setFiltr = function () {

     var param = { "name" : "payment"
     };

     Controller['payment'].data = {"class" : "ViewPayment", "method" : 'showMainTable', "param" : param };
     Controller['payment'].showMainTable();

     // upload data from 1C
     $('#submit_load_files').hide();
     $('#btn_load_file').change(function(){
         Controller.files = this.files;

         $('#submit_load_files').show();
         $(".toolbar").off("click", '#submit_load_files', window['loadFiles']);
         $(".toolbar").on("click", '#submit_load_files', Controller['loadFiles']);

     });

 }
 //-----------------------------------------------------------------------------------------------
 ViewPayment.prototype.confirm = function () {

     var dbitem = new window['DbPayment']();

     dbitem.confirm(this.id);
     console.log('view config - ' + dbitem.result['id']);

     Controller['payment']['setFiltr']();
     Controller['payment']['SelectRow'](this.id);
     Controller['payment']['ScrollToRow']();

     return true;
 }
 //-----------------------------------------------------------------------------------------------
 ViewPayment.prototype.showEditDialog = function () {

     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Завершить": function() {
                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             dbitem.id = Controller[obj]['id'];
                             dbitem.finishItem();
                             if (dbitem.result['id'] > 0) {
                                 Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj} };
                                 Controller[obj]['showMainTable']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                         },

                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }


 //----------------------------------------------------------------------------------------------
 function ViewReminder () {
     ViewVisit.apply(this, arguments);
     this.name = 'Reminder';
     this.data = {"class" : "ViewReminder" };
 }

 ViewReminder.prototype = Object.create(ViewVisit.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewReminder.prototype.setFiltr = function () {

     var param = { "name" : "reminder",
         "dt" : $('#reminder_filtr_dt').val()
     };

     Controller['reminder'].data = {"class" : "ViewReminder", "method" : 'showMainTable', "param" : param };
     Controller['reminder'].showMainTable();

 }
 //-----------------------------------------------------------------------------------------------
 ViewReminder.prototype.confirm = function () {

     var dbitem = new window['DbReminder']();

     dbitem.confirm(this.id);
     console.log('reminder config - ' + dbitem.result['id']);

     Controller['reminder']['setFiltr']();
     Controller['reminder']['SelectRow'](this.id);
     Controller['reminder']['ScrollToRow']();

     return true;
 }
 //**********************************************************************************************

 function ViewDoctor () {
     ViewItem.apply(this, arguments);
     this.name = 'Doctor';
     this.data = {"class" : "ViewDoctor" };
     this.status = 0;
     this.id = [0, 0, 0, 0];
     this.scroll_top = [0, 0, 0, 0];
 }

 ViewDoctor.prototype = Object.create(ViewItem.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.setFiltr = function () {

     Controller['doctor'].status = $( "#s_tabs" ).tabs( "option", "active");

     var param = { "name" : "doctor",
         "manager" : $('#doctor_filtr_manager-' + Controller['doctor'].status + ' option:selected').val(),
         "ind" : Controller['doctor'].status
     };


     Controller['doctor'].data = {"class" : "ViewDoctor", "method" : 'showMainTable', "param" : param };

     Controller['doctor'].showMainTable();

 }


 ViewDoctor.prototype.showMainTable = function () {

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,          // classname, method, param {name}
         dataType: 'json',
         success: $.proxy(function(data) {
             if(data['success']) {

                 this.status = data['ind'];

                 this.btn_add = data['btn_add'];
                 this.btn_edit = data['btn_edit'];
                 this.btn_read = data['btn_read'];
                 this.btn_delete = data['btn_delete'];

                 $('#' + data['div'] + '-' + data['ind']).html(data['html']);
                 $(".table-data").on("click", 'tr', Controller.trClick);

                 $('#' + data['div'] + '-' + data['ind']).scrollTop(this.scroll_top[data['ind']]);

                 $(".toolbar").off("change", '.set-filtr');

                 this.btnStatus(0);

                 $(".toolbar").on("change", '.set-filtr', this.setFiltr);

              //   $('#' + data['btn_edit'] + '-' + data['ind']).hide();
              //   $('#' + data['btn_delete'] + '-' + data['ind']).hide();

             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 ViewDoctor.prototype.SelectRow = function (id) {

     this.id[this.status] = id;
     this.scroll_top[this.status] = $('#' + this.div[this.status]).scrollTop();

     this.btnStatus(id);

   //  $('#' + this.btn_edit + "-" + this.status).show();
   //  $('#' + this.btn_delete + "-" + this.status).show();

     return 1;
 }

 ViewDoctor.prototype.ScrollToRow = function () {

     if(this.id[this.status] > 0) {

         $("#" + this.name + "-" + this.id[this.status] + " td").addClass("td_cursor");
         $('#' + this.div[this.status]).scrollTop(0);

         var height = $('#' + this.div[this.status]).height();
         if (height < this.scroll_top[this.status])
             $('#' + this.div[this.status]).scrollTop(this.scroll_top[this.status]);

     }

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.btnStatus = function (id) {

     var param = { "page" : Controller.page - 1, "tab" : Controller.tab, "id" : id };
     this.data = {"class" : "View" + Controller.class_name, "method" : 'btnStatus', "param" : param };

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,          // classname, method, param {name}
         dataType: 'json',

         success: $.proxy(function(data) {

             if(data['success']) {

                 if(data['btn_add']*1)
                     $('#' + this.btn_add + "-" + this.status).show();
                 else
                     $('#' + this.btn_add + "-" + this.status).hide();


                 if(data['btn_save']*1) {
                     $('#' + this.btn_read + "-" + this.status).hide();
                     $('#' + this.btn_edit + "-" + this.status).show();
                 }
                 else {
                     $('#' + this.btn_edit + "-" + this.status).hide();
                     if(data['id'] > 0)
                        $('#' + this.btn_read + "-" + this.status).show();
                     else
                         $('#' + this.btn_read + "-" + this.status).hide();
                 }




                 if(data['btn_del']*1)
                     $('#' + this.btn_delete + "-" + this.status).show();
                 else
                     $('#' + this.btn_delete + "-" + this.status).hide();


             } else
                 alert(data['msg']);
         }, this)

     });

     return 1;
 }

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.showAddDialog = function () {

     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Добавить": function() {

                             var dbitem = new window[ 'Db' + Controller.class_name ]();;
                             dbitem.addItem();
                             var obj = Controller.obj_name;
                             var status = Controller[obj].status;
                             Controller[obj]['id'][status] = dbitem.result['id'];
                             if(dbitem.result['id'] > 0) {
                             //    Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj, "ind" : status} };
                                 Controller[obj]['setFiltr']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                             alert(dbitem.result['msg']);
                         },
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');

                 $( "#edit_special" ).autocomplete({
                     source: "search_special.php",
                     minLength: 2,
                     select: function( event, ui ) {
                         $('#edit_special').attr('value',ui.item.value);
                     }
                 });

                 $( "#edit_clinic" ).autocomplete({
                     source: "search_clinic.php",
                     minLength: 2,
                     select: function( event, ui ) {
                         $('#edit_clinic').attr('value',ui.item.value);
                     }
                 });

                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 this.editStatus();
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.showEditDialog = function () {


     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id[this.status]};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons: {
                         "Отмена": function () {
                             $(this).dialog('destroy').remove();
                         },
                         "Сохранить": function () {

                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             var status = Controller[obj].status;

                             dbitem.id = Controller[obj]['id'][status];

                             dbitem.saveItem();
                             if (dbitem.result['id'] > 0) {

                                 //  Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj, "ind" : status} };
                                 Controller[obj]['setFiltr']();
                                 Controller[obj]['SelectRow'](dbitem.result['id']);
                                 Controller[obj]['ScrollToRow']();
                                 $(this).dialog('destroy').remove();
                             }
                         }
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');

                 $( "#edit_special" ).autocomplete({
                     source: "search_special.php",
                     minLength: 2,
                     select: function( event, ui ) {
                         $('#edit_special').attr('value',ui.item.value);
                     }
                 });

                 $( "#edit_clinic" ).autocomplete({
                     source: "search_clinic.php",
                     minLength: 2,
                     select: function( event, ui ) {
                         $('#edit_clinic').attr('value',ui.item.value);
                     }
                 });


                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 this.editStatus();
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.showReadDialog = function () {

     var param = {"tpl" : "dialog/edit" + this.name + ".tpl", "name" : this.name, "id" : this.id[this.status]};
     this.data['param'] = param;
     this.data['method'] = 'showEditDialog';

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons: {
                         "Отмена": function () {
                             $(this).dialog('destroy').remove();
                         }
                     },
                     autoOpen: false,
                     width: 500,
                     height: 390,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');

             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------------------------
 ViewDoctor.prototype.showDeleteDialog = function () {

     //  alert('name=' + this.name + ' id:' + this.id);
     var param = {"tpl" : "dialog/delete" + this.name + ".tpl", "name" : this.name, "id" : this.id[this.status]};
     this.data['param'] = param;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons:{
                         "Отмена": function()
                         {
                             $(this).dialog('destroy').remove();
                         },
                         "Удалить": function() {

                             var obj = Controller.obj_name;
                             var dbitem = new window['Db' + Controller.class_name]();
                             var status = Controller[obj].status;
                             dbitem.param = {"id" : Controller[obj]['id'][status]}
                             dbitem.deleteItem();

                             if (dbitem.result['id'] == 0) {

                             //    Controller[obj].data = {"class" : "View" + Controller.class_name, "method" : 'showMainTable', "param" : {"name" : obj, "ind" : status} };
                                 Controller[obj]['setFiltr']();

                                 $(this).dialog('destroy').remove();
                             }
                         },
                     },
                     autoOpen: false,
                     width: 300,
                     height: 200,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }


 //**********************************************************************************************

 function ViewPatient () {
     ViewItem.apply(this, arguments);
     this.name = 'Patient';
     this.status = 0;
     this.id = [0, 0, 0, 0];
     this.scroll_top = [0, 0, 0, 0];
 }

 ViewPatient.prototype = Object.create(ViewDoctor.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewPatient.prototype.setFiltr = function () {

     Controller['patient'].status = $( "#s_tabs" ).tabs( "option", "active");

     var param = { "name" : "patient",
         "doctor" : $('#patient_filtr_doctor-' + Controller['patient'].status).val(),
         "ind" : Controller['patient'].status
     };

     Controller['patient'].data = {"class" : "ViewPatient", "method" : 'showMainTable', "param" : param };
     Controller['patient'].showMainTable();


 }

 //-----------------------------------------------------------------------------------------------
 ViewPatient.prototype.editStatus = function (id) {
   /*  if(Controller.tab == 0) {
         $('#edit_mo_id').attr("readonly","true");
         $('#edit_dt_consultion').attr("readonly","true");
     } else {
         $('#edit_name').attr("readonly","true");
     }*/

 }
 //***********************************************************************************************

 //----------------------------------------------------------------------------------------------
 function ViewRepmanager () {
     ViewVisit.apply(this, arguments);
     this.name = 'Repmanager';
     this.data = {"class" : "ViewRepmanager" };

 }

 ViewRepmanager.prototype = Object.create(ViewVisit.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewRepmanager.prototype.setFiltr = function () {

     var param = { "name" : "repmanager",
         "region" : $('#repmanager_filtr_region option:selected').val(),
         "dt_start" : $('#repmanager_filtr_dt_start').val(),
         "dt_end" : $('#repmanager_filtr_dt_end').val()
     };


     Controller['repmanager'].data = {"class" : "ViewRepmanager", "method" : 'showMainTable', "param" : param };
     Controller['repmanager'].showMainTable();

     $('#repmanager-total').html(Controller['repmanager'].total);

 }


 //----------------------------------------------------------------------------------------------
 function ViewRepdoctor () {
     ViewVisit.apply(this, arguments);
     this.name = 'Repdoctor';
     this.data = {"class" : "ViewRepdoctor" };
 }

 ViewRepdoctor.prototype = Object.create(ViewVisit.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewRepdoctor.prototype.setFiltr = function () {

     var param = { "name" : "repdoctor",
         "special" : $('#repdoctor_filtr_special option:selected').val(),
         "clinic" : $('#repdoctor_filtr_clinic option:selected').val(),
         "dt_start" : $('#repdoctor_dt_start').val(),
         "dt_end" : $('#repdoctor_dt_end').val()
     };


     Controller['repdoctor'].data = {"class" : "ViewRepdoctor", "method" : 'showMainTable', "param" : param };
     Controller['repdoctor'].showMainTable();

     $('#repdoctor-total').html(Controller['repdoctor'].total);

 }

 //----------------------------------------------------------------------------------------------
 function ViewReppatient () {
     ViewVisit.apply(this, arguments);
     this.name = 'Reppatient';
     this.data = {"class" : "ViewReppatient" };
     this.total = 0;
 }

 ViewReppatient.prototype = Object.create(ViewVisit.prototype);

 //-----------------------------------------------------------------------------------------------
 ViewReppatient.prototype.setFiltr = function () {

     var param = { "name" : "reppatient",
         "doctor" : $('#reppatient_filtr_doctor option:selected').val(),
         "manager" : $('#reppatient_filtr_manager option:selected').val(),
         "dt_start" : $('#reppatient_filtr_dt_start').val(),
         "dt_end" : $('#reppatient_filtr_dt_end').val()
     };

console.log('set param');
     Controller['reppatient'].data = {"class" : "ViewReppatient", "method" : 'showMainTable', "param" : param };
     Controller['reppatient'].showMainTable();

     $('#reppatient-total').html(Controller['reppatient'].total);

 }
 
 //----------------------------------------------------------------------------------------------
 function ViewAdmin () {
     ViewItem.apply(this, arguments);
     this.name = 'Admin';
     this.data = {"class" : "ViewAdmin" };
 }

 ViewAdmin.prototype = Object.create(ViewItem.prototype);

 //----------------------------------------------------------------------------------------------

 ViewAdmin.prototype.setFiltr = function () {


     return true;
 }

 ViewAdmin.prototype.showList = function () {

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,          // classname, method, param {name}
         dataType: 'json',

         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#' + data['span']).html(data['html']);

                 $("#" + data['select_id'] + " option[value='" + data['id'] + "']").prop('selected', true);

                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 $('#' + data['div']).on("change", '.dict-select', this.onDictSelect);
              //   $('.dict-item').val('');

             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 //-----------------------------------------------------------------------------
 ViewAdmin.prototype.showEditDialog = function () {

  //   alert(this.id);
     this.data['method'] = 'showAdmin' + this.id + 'Dialog';

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,
         dataType: 'json',
         success: $.proxy(function(data) {

             if(data['success']) {

                 $('#sp_dialog').html(data['html']);

                 $('#' + data['dialog_id']).dialog
                 ({
                     close: function(event, ui)
                     {

                         $(this).dialog('destroy').remove();
                     },
                     buttons: this['' + data['buttons'] ],
                     autoOpen: false,
                     width: 600,
                     height: 460,
                     resizable: true,
                     modal: true
                 });
                 $('#' + data['dialog_id']).dialog('open');
                 $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});
                 $('#' + data['dialog_id']).off("change", '.dict-select', this.onDictSelect);
                 $('#' + data['dialog_id']).on("change", '.dict-select', this.onDictSelect);
             } else
                 alert(data['msg']);
         }, this)

     });

     return true;
 }

 ViewAdmin.prototype.dialog_buttons = {
     "Закрыть": function () {
         $(this).dialog('destroy').remove();
     },
     "Сохранить": function () {
         var obj = Controller.obj_name;
         var dbitem = new window['Db' + Controller.class_name]();
         dbitem.id = Controller[obj]['id'];
         dbitem.saveItem();
         if (dbitem.result['id'] > 0) {
             alert(dbitem.result['msg']);
         }
     }
 }

 ViewAdmin.prototype.dialog_dict_buttons = {
     "Закрыть": function () {
         $(this).dialog('destroy').remove();
     },
     "Удалить": function() {

         var obj = Controller.obj_name;
         var dbitem = new window['Db' + Controller.class_name]();
         var status = Controller[obj].status;
         dbitem.param = {"id" : Controller[obj]['id'][status]}
         dbitem.deleteItem();

         if (dbitem.result['id'] == 0) {
             alert(dbitem.result['msg']);
             Controller[obj].data = {
                 "class": "View" + Controller.class_name,
                 "method": 'showList',
                 "param": {"select_id" : $('.dict-select').attr('id'), "id" : dbitem.result['id'] }
             };
             Controller[obj]['showList']();
         }
     },
     "Сохранить": function () {

         var obj = Controller.obj_name;
         var dbitem = new window['Db' + Controller.class_name]();
         dbitem.id = Controller[obj]['id'];

         dbitem.saveItem();

         if (dbitem.result['id'] > 0) {
             alert(dbitem.result['msg']);
             Controller[obj].data = {
                 "class": "View" + Controller.class_name,
                 "method": 'showList',
                 "param": {"select_id" : $('.dict-select').attr('id'), "id" : dbitem.result['id'] }
             };

             Controller[obj]['showList']();

         }
     },
     "Добавить": function () {

         var obj = Controller.obj_name;
         var dbitem = new window['Db' + Controller.class_name]();
         dbitem.id = Controller[obj]['id'];
         dbitem.addItem();
         if (dbitem.result['id'] > 0) {
             alert(dbitem.result['msg']);
             Controller[obj].data = {
                 "class": "View" + Controller.class_name,
                 "method": 'showList',
                 "param": {"select_id" : $('.dict-select').attr('id'), "id" : dbitem.result['id'] }
             };
             Controller[obj]['showList']();
         }
     }
 }

 //---------------------

 ViewAdmin.prototype.onDictSelect = function () {

     this.data = {
         "class": "ViewAdmin",
         "method": 'showItemData',
         "param": {"select_id" : $(this).attr('id'), "id" : $('option:selected', this).val() }
     };

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: this.data,          // classname, method, param {name}
         dataType: 'json',

         success: $.proxy(function(data) {
                 var obj = Controller.obj_name;
                 Controller[obj].data = data;
             console.log(data['method']);
                 Controller[obj][data['method']](data);

         }, this)

     });

    // $('.dict-item').val($('option:selected', this).text());
 }

 //--------------------------------------------

 ViewAdmin.prototype.setClinicData = function (data) {
console.log(data['id']);
     $("#edit_region option[value='" + data['region'] + "']").prop('selected', true);
     $('.dict-item').val(data['name']);
 }

 ViewAdmin.prototype.setSpecialData = function (data) {
     console.log(data['id']);
     $('.dict-item').val(data['name']);
 }

 ViewAdmin.prototype.setUserData = function (data) {
     $("#edit_group option[value='" + data['gid'] + "']").prop('selected', true);
     $('#edit_name').val(data['name']);
     $('#edit_login').val(data['login']);
 }
 //####################################################################################################


