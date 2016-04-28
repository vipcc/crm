<table id="manager_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="29%"></th>
    <th width="20%"></th>
    <th width="7%"></th>
    <th width="7%"></th>
    <th width="7%"></th>
    </thead>
    <tbody>

    {foreach $records as $manager}
        <tr id="Manager-{$manager.id}" style="color:{$manager.color}">
            <td >{$manager.name}</td>
            <td >{$manager.region}</td>
            <td >{$manager.doctor}</td>
            <td >{$manager.plan}</td>
            <td >{$manager.visits}</td>
        </tr>
    {/foreach}
    </tbody>
</table>