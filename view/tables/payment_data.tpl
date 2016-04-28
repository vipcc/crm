<table id="payment_table_data" cellspacing="1" class="table-data">
    <thead>
    <th width="50%"></th>
    <th width="25%"></th>
    <th width="25%"></th>
    </thead>
    <tbody>

    {foreach $records as $payment}
        <tr id="Payment-{$payment.id}" style="color:{$payment.color}">
            <td >{$payment.doctor}</td>
            <td >{$payment.dt}</td>
            <td >{$payment.sum}</td>
        </tr>
    {/foreach}
    </tbody>
</table>