

<table id="patient_table_head-{$status}" cellspacing="1" class="table-head">
    <thead>
    <tr>
        <th id="patient_tbl_head_name-{$status}" width="40%">ФИО пациента </th>
        <th id="patient_tbl_head_region-{$status}" width="20%">Дата напр-я</th>
        <th id="patient_tbl_head_patient-{$status}" width="40%">Кто направил</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td colspan="6"></td>
    </tr>
    </tbody>
</table>
<div id="div_patient_main_table-{$status}" class="div-table-data">
    {include file='tables/patient_data.tpl'}
</div>


