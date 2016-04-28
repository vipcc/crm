<table id="patient_table_data-{$status}" cellspacing="1" class="table-data">
    <thead>
    <th width="40%"></th>
    <th width="20%"></th>
    <th width="40%"></th>
    </thead>
    <tbody>

    {foreach $records as $patient}
        <tr id="Patient-{$patient.id}">
            <td >{$patient.name}</td>
            <td >{$patient.region}</td>
            <td ></td>
        </tr>
    {/foreach}
    </tbody>
</table>