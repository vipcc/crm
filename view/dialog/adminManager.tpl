<div id="admin_manager_dialog" class="dialog" title="Медицинский представитель">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="60%">
                <select id="edit_manager" style="width: 98%;" multiple size="15" class="dict-select">
                    {foreach $managers as $manager}
                        <option value="{$manager.id}" {if $manager.id == $data.manager} selected {/if}>{$manager.name}</option>
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




