

<table id="doctor_table_head-{$status}" cellspacing="1" class="table-head">
    <thead>
    <tr>
        <th id="doctor_tbl_head_name-{$status}" width="30%">ФИО  </th>
        <th id="doctor_tbl_head_region-{$status}" width="20%">Должность</th>
        <th id="doctor_tbl_head_doctor-{$status}" width="25%">ЛУ</th>
        <th id="doctor_tbl_head_plan-{$status}" width="10%">Телефон</th>
        <th id="doctor_tbl_head_fakt-{$status}" width="15%">e-mail</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td colspan="6"></td>
    </tr>
    </tbody>
</table>
<div id="div_doctor_main_table-{$status}" class="div-table-data">
    {include file='tables/doctor_data.tpl'}
</div>


