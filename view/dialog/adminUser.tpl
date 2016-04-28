<div id="admin_user_dialog" class="dialog" title="Пользователи">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="60%" rowspan="7"><span id="admin_user_list">
                <select id="edit_user" style="width: 98%;" multiple size="15" class="dict-select">
                    {foreach $users as $user}
                        <option value="{$user.id}" {if $user.id == $data.user} selected {/if}>{$user.name}</option>
                    {/foreach}
                </select>
                </span>
            </td>
            <td width="40%">&nbsp ФИО:<br>
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;" class="dict-item">
            </td>
        </tr>
        <tr>
            <td width="40%">&nbsp Имя пользователя:<br>
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_login" value="{$data.login}" style="width: 98%;" class="dict-item">
            </td>
        </tr>
        <tr>
            <td >&nbsp Группа:<br>
                <select id="edit_group" style="width: 98%;">
                    {foreach $groups as $group}
                        <option value="{$group.id}" {if $group.id == $data.group} selected {/if}>{$group.name}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td rowspan="5">&nbsp </td>
        </tr>
    </table>
</div>




