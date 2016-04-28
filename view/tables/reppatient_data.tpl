<table id="reppatient_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="15%"></th>
    <th width="10%"></th>
    <th width="10%"></th>
    <th width="22%"></th>
    <th width="10%"></th>
    <th width="23%"></th>
    <th width="10%"></th>
    </thead>
    <tbody>

    {foreach $records as $record}
        <tr id="Reppatient-{$record.id}">
            <td ></td>
            <td >{$record.dt_plan}</td>
            <td >{$record.dt_consultion}</td>
            <td >{$record.doctor}</td>
            <td >{$record.mo_id}</td>
            <td >{$record.patient}</td>
            <td >{$record.comment}</td>
        </tr>
    {/foreach}
    </tbody>
</table>