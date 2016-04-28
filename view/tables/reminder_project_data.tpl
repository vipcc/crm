<table id="reminder_project_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="5%"></th>
    <th width="30%"></th>
    <th width="15%"></th>
    <th width="50%"></th>
    </thead>
    <tbody>

    {foreach $records as $remind}
        <tr id="Reminder-{$remind.id}">
            <td >{$remind.id}</td>
            <td ></td>
            <td ></td>
            <td ></td>
        </tr>
    {/foreach}
    </tbody>
</table>