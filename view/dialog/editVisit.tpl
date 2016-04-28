<div id="add_visit_dialog" class="dialog" title="Визит">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">Мед.представитель:</td>
            <td width="70%">
                <select id="edit_manager" style="width: 98%;">
                    {foreach $managers as $manager}
                        <option value="{$manager.id}" {if $manager.id == $data.manager} selected {/if}> {$manager.name} </option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Дата:</td>
            <td><input type="text" id="edit_dt" class='edit-dt' value="{$data.dt}" style="width: 30%;">&nbsp</td>
        </tr>
        <tr>
            <td>Врач:</td>
            <td>
                <select id="edit_doctor" style="width: 98%;">
                    <option value="0"></option>
                    {foreach $doctors as $doctor}
                        <option value="{$doctor.id}" {if $doctor.id == $data.doctor} selected {/if}> {$doctor.name} </option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>ЛУ:</td>
            <td>
                <select id="edit_clinic" style="width: 98%;">
                        <option value="0"></option>
                    {foreach $clinics as $clinic}
                        <option value="{$clinic.id}" {if $clinic.id == $data.clinic} selected {/if}> {$clinic.name} </option>
                    {/foreach}
                </select>
            </td>
        </tr>

        <tr>
            <td>Расходы:</td>
            <td><input type="text" id="edit_expens" value="{$data.expens}" style="width: 98%;">&nbsp</td>
        </tr>
        <tr>
            <td>Комментарий:</td>
            <td><textarea id="edit_comment" rows="7" style="width: 98%;">{$data.comment} </textarea>&nbsp</td>
        </tr>
        <tr>
            <td>След визит:</td>
            <td><input type="text" id="edit_dt_plan" class='edit-dt' value="{$data.dt_plan}" style="width: 30%;">&nbsp</td>
        </tr>

    </table>
</div>




