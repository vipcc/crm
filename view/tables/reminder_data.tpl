<table id="reminder_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="10%"></th>
    <th width="25%"></th>
    <th width="15%"></th>
    <th width="50%"></th>
    </thead>
    <tbody>

    {foreach $records as $remind}
        <tr id="Reminder-{$remind.id}">
            <td >{$remind.dt}</td>
            <td >{$remind.name}</td>
            <td >{$remind.phone}</td>
            <td >{$remind.comment}</td>
        </tr>
    {/foreach}
    </tbody>
</table>