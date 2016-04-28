<table id="repmanager_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="46%"></th>
    <th width="12%"></th>
    <th width="12%"></th>
    <th width="15%"></th>
    <th width="15%"></th>
    </thead>
    <tbody>

    {foreach $records as $record}
        <tr id="Repmanager-{$record.id}">
            <td >{$record.name}</td>
            <td >{$record.doctors}</td>
            <td >{$record.patients}</td>
            <td >{$record.sum}</td>
            <td >{$record.bonus}</td>
        </tr>
    {/foreach}
    </tbody>
</table>