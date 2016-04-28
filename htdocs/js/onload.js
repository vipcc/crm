$(document).ready
(
    function()
    {

        $(".toolbar").on("click", '.click', Controller.click);
      //  $(".toolbar").on("change", '.set-dt', Controller.refresh);
        $("#s_tabs").on("change", '#ShowPage', Controller.page);

        $('#s_tabs').tabs();
        $('#s_tabs').on( "tabsactivate", Controller.tab);
        Controller.page = $('#ShowPage option:selected').val();

        Controller.manager = new ViewManager();
        Controller.doctor = new ViewDoctor();
        Controller.patient = new ViewPatient();
        Controller.visit = new ViewVisit();
        Controller.call = new ViewCall();
        Controller.payment = new ViewPayment();
        Controller.reminder = new ViewReminder();
        Controller.repmanager = new ViewRepmanager();
        Controller.repdoctor = new ViewRepdoctor();
        Controller.reppatient = new ViewReppatient();
        Controller.admin = new ViewAdmin();


        Controller.runTab($( "#s_tabs" ).tabs( "option", "active"));



        $(window).on('resize', setWindowSize);
        setWindowSize();
        $('.edit-dt').datepicker({dateFormat: 'dd.mm.yy'});

        $(".table-data").on("click", 'tr', Controller.trClick);

    }
);


function callTimer() {

    var obj = new DbItem();
    if(obj.checkRefresh() > 0) {
        console.log("have changes");
        Controller['call']['setFiltr']();
        Controller['call']['ScrollToRow']();
    }

    setTimeout(callTimer, 1000);
}

function visitTimer() {

 //   Controller['visit']['showMainTable']();
}