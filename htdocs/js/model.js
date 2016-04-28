 function Calls () {
     alert('call');

     setTimeout(Calls, 2000);

     return true;

 }

 //################################################################################################
 function DbItem () {
     this.id = 0;
     this.name = '';
     this.param = {};
     this.result = {};

 }

 DbItem.prototype.addItem = function () {
     this.getInput();
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'addItem', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }

 DbItem.prototype.saveItem = function () {
     this.getInput();
     this.param['id'] = this.id;
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'saveItem', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }

 DbItem.prototype.deleteItem = function () {

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'deleteItem', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }

 DbItem.prototype.checkRefresh = function () {
//alert('db:' + Controller['obj_name']);
     var param = {"name" : Controller['obj_name']};
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "ModelItem", "method":'checkRefresh', "param":param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 };
 //##############################################################################################
 //----------------------------------------------------------------------------------------------
 function DbManager () {
     DbItem.apply(this, arguments);
     this.name = 'Manager';
 }

 DbManager.prototype = Object.create(DbItem.prototype);

 DbManager.prototype.getInput = function () {

     var phones = {};

     $('.phone').each(function(){
         if( $(this).val() != '') {
             var id = $(this).attr('id');
             var tp = $('#tp_' + id).val();

             phones['' + tp] = $(this).val();
         }
     });

     this.param = { "id":$('#edit_id').val(),
         "user":$('#edit_user option:selected').val(),
         "region":$('#edit_region option:selected').val(),
         "phones":phones,
         "email":$('#edit_email').val(),
         "plan":$('#edit_plan').val()
     };
 }

 //----------------------------------------------------------------------------------------------
 function DbVisit () {
     DbItem.apply(this, arguments);
     this.name = 'Visit';
 }

 DbVisit.prototype = Object.create(DbItem.prototype);

 DbVisit.prototype.getInput = function () {

     this.param = {
         "manager" : $('#edit_manager option:selected').val(),
         "dt":$('#edit_dt').val(),
         "doctor" : $('#edit_doctor option:selected').val(),
         "clinic" : $('#edit_clinic option:selected').val(),
         "expens":$('#edit_expens').val(),
         "comment":$('#edit_comment').val(),
         "dt_plan":$('#edit_dt_plan').val()
     };
 }

 //----------------------------------------------------------------------------------------------
 DbVisit.prototype.confirm = function () {

     this.param = {
         "manager" : $('#visit_filtr_manager option:selected').val(),
         "dt" : $('#visit_filtr_dt').val()
     };
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'confirm', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }

 //----------------------------------------------------------------------------------------------
 DbVisit.prototype.deconfirm = function () {

     this.param = {
         "manager" : $('#visit_filtr_manager option:selected').val(),
         "dt" : $('#visit_filtr_dt').val()
     };
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'deconfirm', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }

 //----------------------------------------------------------------------------------------------
 function DbPayment () {
     DbVisit.apply(this, arguments);
     this.name = 'Payment';
 }

 DbPayment.prototype = Object.create(DbVisit.prototype);

 DbPayment.prototype.getInput = function () {};

 //----------------------------------------------------------------------------------------------
 DbPayment.prototype.confirm = function (id) {

     this.param = { "id" : id };
     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":'confirm', "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }
 //----------------------------------------------------------------------------------------------
 function DbReminder () {
     DbPayment.apply(this, arguments);
     this.name = 'Reminder';
 }

 DbReminder.prototype = Object.create(DbPayment.prototype);

 DbReminder.prototype.getInput = function () {
     this.param = {
         "name" : $('#edit_name').val(),
         "dt":$('#edit_dt').val(),
         "phone" : $('#edit_phone').val(),
         "comment":$('#edit_comment').val()
     };
 };


 //----------------------------------------------------------------------------------------------
 function DbCall () {
     DbVisit.apply(this, arguments);
     this.name = 'Call';
 }

 DbCall.prototype = Object.create(DbVisit.prototype);

 DbCall.prototype.getInput = function () {
     this.param = {
         "name" : $('#edit_name').val(),
         "mo_id" : $('#edit_mo_id').val(),
         "patient_name" : $('#edit_patient_name').val(),
         "doctor" : $('#edit_doctor').val(),
         "comment":$('#edit_comment').val()
     };
 };


 //----------------------------------------------------------------------------------------------
 function DbDoctor () {
     DbItem.apply(this, arguments);
     this.name = 'Doctor';
 }

 DbDoctor.prototype = Object.create(DbItem.prototype);

 DbDoctor.prototype.getInput = function () {

     var phones = {};

     $('.phone').each(function(){
         if( $(this).val() != '') {
             var id = $(this).attr('id');
             var tp = $('#tp_' + id).val();
             phones['' + tp] = $(this).val();
         }
     });

     this.param = {
         "name":$('#edit_name').val(),
         "manager":$('#edit_manager option:selected').val(),
         "special":$('#edit_special').val(),
         "clinic":$('#edit_clinic').val(),
         "status":$('#edit_status option:selected').val(),
         "email":$('#edit_email').val(),
         "phones":phones,
         "card":$('#edit_card').val(),
         "comment":$('#edit_comment').val()
     };
 }

 //----------------------------------------------------------------------------------------------
 function DbPatient () {
     DbItem.apply(this, arguments);
     this.name = 'Patient';
 }

 DbPatient.prototype = Object.create(DbItem.prototype);

 DbPatient.prototype.getInput = function () {

     this.param = {
         "name":$('#edit_name').val(),
         "doctor":$('#edit_doctor option:selected').val(),
         "dt_plan":$('#edit_email').val(),
         "mo_id":$('#edit_mo_id').val(),
         "diagnosis":$('#edit_diagnosis').val(),
         "dt_consultion":$('#edit_dt_consultion').val(),
         "comment":$('#edit_comment').val()
     };
 }


 //----------------------------------------------------------------------------------------------
 function DbAdmin () {
     DbItem.apply(this, arguments);
     this.name = 'Admin';
 }

 DbAdmin.prototype = Object.create(DbItem.prototype);

 DbAdmin.prototype.addItem = function () {
     var select_id =  $('.dict-select').attr('id');
     var str = select_id.split('_');
     var item = str[1].charAt(0).toUpperCase() + str[1].slice(1);
     var func = 'get' + item;

     this[func]();

     var method = 'add' + item;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":method, "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }
 //-----------------------------------------------------------------------------------------------------------------
 DbAdmin.prototype.saveItem = function () {
     var select_id =  $('.dict-select').attr('id');
     var str = select_id.split('_');
     var item = str[1].charAt(0).toUpperCase() + str[1].slice(1);
     var func = 'get' + item;

     this[func]();

     var method = 'save' + item;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":method, "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this)
     });

     return this.result;

 }
 //-----------------------------------------------------------------------------------------------------------------
 DbAdmin.prototype.deleteItem = function () {
     var select_id =  $('.dict-select').attr('id');
     var str = select_id.split('_');
     var item = str[1].charAt(0).toUpperCase() + str[1].slice(1);
     var func = 'get' + item;       // get data for select dict (id, name, ...)

     this[func]();

     var method = 'delete' + item;

     $.ajax({
         type: 'POST',
         async: false,
         url: "ajax.php",
         data: {"class": "Model" + this.name, "method":method, "param":this.param },     //      json data to send
         dataType: 'json',
         success: $.proxy(function(data) {
             this.result = data;
         }, this),

         error: $.proxy(function() {
             this.result= { "id" : 0, "msg" : "Ошиюка доступа к серверу." };

         }, this),
     });

     return this.result;

 }
 DbAdmin.prototype.getInput = function () {

     var select_id =  $('.dict-select').attr('id');

     this.param = { "select_id" : select_id,
         "name":$('#edit_name').val(),
         "id":$('#' + select_id + ' option:selected').val()
     };
 }

 DbAdmin.prototype.getClinic = function () {

     var select_id =  $('.dict-select').attr('id');

     this.param = { "select_id" : select_id,
         "region":$('#edit_region option:selected').val(),
         "name":$('#edit_name').val(),
         "id":$('#' + select_id + ' option:selected').val()
     };
 }

 DbAdmin.prototype.getSpecial = function () {

     var select_id =  $('.dict-select').attr('id');

     this.param = { "select_id" : select_id,
         "name":$('#edit_name').val(),
         "id":$('#' + select_id + ' option:selected').val()
     };
 }
//---------------------------------------------------------------------------------------------------
 DbAdmin.prototype.getUser = function () {

     var select_id =  $('.dict-select').attr('id');

     this.param = { "select_id" : select_id,
         "name":$('#edit_name').val(),
         "login":$('#edit_login').val(),
         "gid":$('#edit_group option:selected').val(),
         "id":$('#' + select_id + ' option:selected').val()
     };
 }
 //---------------------------------------------------------------------------------------------------