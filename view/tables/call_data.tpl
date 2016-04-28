<table id="call_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="30%"></th>
    <th width="15%"></th>
    <th width="15%"></th>
    <th width="10%"></th>
    <th width="30%"></th>
    </thead>
    <tbody>

    {foreach $records as $call}
        <tr {if $call.event == "разговор"} id="Call-{$call.id}" {else} id="Call-0-{$call.id}" {/if} style="color:{$call.color}">
            <td >{$call.name}</td>
            <td >{$call.event}</td>
            <td >{$call.callerCID}</td>
            <td >{$call.time}</td>
            <td >{$call.operator}</td>
        </tr>
    {/foreach}
    </tbody>
</table>