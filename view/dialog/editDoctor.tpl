<div id="add_doctor_dialog" class="dialog" title="Врач">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">ФИО:</td>
            <td width="70%">
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td>Должность:</td>
            <td> <input type="text" id="edit_special" value="{$data.special}" style="width: 98%;"> </td>
        </tr>
        <tr>
            <td>ЛУ:</td>
            <td> <input type="text" id="edit_clinic" value="{$data.clinic}" style="width: 98%;"> </td>
        </tr>

        <tr>
            <td>Тел.:</td>
            <td>

                {include file='dialog/doctor_contacts.tpl'}

            </td>
        </tr>
        <tr>
            <td>E-mail.:</td>
            <td><input type="text" id="edit_email" value="{$data.email}" style="width: 98%;"></td>
        </tr>
        <tr>
            <td>Банк. карта:</td>
            <td><input type="text" id="edit_card" value="{$data.card}" style="width: 60%;">

            </td>
        </tr>
        <tr>
            <td>Статус:</td>
            <td>
                <select id="edit_status" style="width: 98%;">
                    <option value="0" {if $data.status == 0} selected {/if}>активный</option>
                    <option value="1" {if $data.status == 1} selected {/if}>статусный</option>
                    <option value="2" {if $data.status == 2} selected {/if}>отказ</option>
                    <option value="3" {if $data.status == 3} selected {/if}>не сотрудничает</option>

                </select>
            </td>
        </tr>
        <tr>
            <td>МП:</td>
            <td>
                <select id="edit_manager" style="width: 98%;">
                    {foreach $managers as $manager}
                        {if $manager.id == $data.manager}
                        <option value="{$manager.id}"  selected > {$manager.name} </option>
                        {/if}
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Примечания </td>
            <td><textarea id="edit_comment" rows="4" style="width: 98%;">{$data.comment} </textarea></td>
        </tr>

    </table>
</div>




