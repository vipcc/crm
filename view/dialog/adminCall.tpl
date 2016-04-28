<div id="admin_call_dialog" class="dialog" title="Оператор Call-центра">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="60%">
                <select id="edit_call" style="width: 98%;" multiple size="15" class="dict-select">
                    {foreach $calls as $call}
                        <option value="{$call.id}" {if $call.id == $data.call} selected {/if}>{$call.name}</option>
                    {/foreach}
                </select>
            </td>
            <td width="40%">&nbsp Имя пользователя:<br>
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_login" value="{$data.login}" style="width: 98%;" class="dict-item">
            </td>
        </tr>
    </table>
</div>




