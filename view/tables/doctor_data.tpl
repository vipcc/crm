<table id="doctor_table_data-{$status}" cellspacing="1" class="table-data">
    <thead>
    <th width="30%"></th>
    <th width="20%"></th>
    <th width="25%"></th>
    <th width="10%"></th>
    <th width="15%"></th>
    </thead>
    <tbody>

    {foreach $records as $doctor}
        <tr id="Doctor-{$doctor.id}">
            <td >{$doctor.name}</td>
            <td >{$doctor.special}</td>
            <td >{$doctor.clinic}</td>
            <td >{$doctor.phone}</td>
            <td >{$doctor.email}</td>
        </tr>
    {/foreach}
    </tbody>
</table>