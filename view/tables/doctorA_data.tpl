<table id="doctor_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="29%"></th>
    <th width="20%"></th>
    <th width="7%"></th>
    <th width="7%"></th>
    <th width="7%"></th>
    </thead>
    <tbody>

    {foreach $doctor_list as $doctor}
        <tr id="Manager-{$doctor.id}">
            <td >{$doctor.name}</td>
            <td >{$doctor.region}</td>
            <td ></td>
            <td ></td>
            <td ></td>
        </tr>
    {/foreach}
    </tbody>
</table>