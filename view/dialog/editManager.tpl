<div id="add_manager_dialog" class="dialog" title="Медицинский представитель">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">ФИО:</td>
            <td width="70%">
                <select id="edit_user" style="width: 98%;">
                    {foreach $users as $user}
                        <option value="{$user.id}" {if $user.id == $data.user} selected {/if}> {$user.name} </option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Регион:</td>
            <td>
                <select id="edit_region" style="width: 98%;">
                    {foreach $regions as $region}
                        <option value="{$region.id}" {if $region.id == $data.region} selected {/if}> {$region.name} </option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Тел.:</td>
            <td>

                {include file='dialog/manager_contacts.tpl'}

            </td>
        </tr>
        <tr>
            <td>E-mail.:</td>
            <td><input type="text" id="edit_email" value="{$data.email}" style="width: 98%;">&nbsp</td>
        </tr>
        <tr>
            <td>План:</td>
            <td><input type="text" id="edit_plan" value="{$data.plan}" style="width: 15%;">&nbsp</td>
        </tr>

    </table>
</div>




