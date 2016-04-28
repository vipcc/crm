<div id="add_reminder_dialog" class="dialog" title="Напоминания звонки">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">ФИО:</td>
            <td width="70%">
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td>Дата:</td>
            <td>
                <input type="text" id="edit_dt" value="{$data.dt}" class="edit-dt" style="width: 30%;">
            </td>
        </tr>
        <tr>
            <td>Тел.:</td>
            <td>
                <input type="text" id="edit_phone" value="{$data.phone}" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td>Примечания </td>
            <td><textarea id="edit_comment" rows="4" style="width: 98%;">{$data.comment} </textarea></td>
        </tr>

    </table>
</div>




