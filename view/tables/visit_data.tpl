<table id="visit_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="10%"></th>
    <th width="20%"></th>
    <th width="20%"></th>
    <th width="30%"></th>
    <th width="10%"></th>
    <th width="10%"></th>
    </thead>
    <tbody>

    {foreach $records as $visit}
        <tr id="Visit-{$visit.id}" style="color:{$visit.color}">
            <td >{$visit.dt}</td>
            <td >{$visit.doctor}</td>
            <td >{$visit.special}</td>
            <td >{$visit.clinic}</td>
            <td >{$visit.phone}</td>
            <td >{$visit.email}</td>

        </tr>
    {/foreach}
    </tbody>
</table>