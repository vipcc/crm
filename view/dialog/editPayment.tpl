<div id="add_payment_dialog" class="dialog" title="Ежедневные начисления">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">Врач:</td>
            <td width="70%">
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" readonly value="{$data.doctor}">
            </td>
        </tr>
        <tr>
            <td>Дата 1-й конс.:</td>
            <td><input type="text" id="edit_dt" value="{$data.dt}" style="width: 25%;"></td>
        </tr>
        <tr>
            <td>Сумма:</td>
            <td><input type="text" id="edit_sum" value="{$data.sum}" style="width: 25%;"></td>
        </tr>
    </table>
</div>




