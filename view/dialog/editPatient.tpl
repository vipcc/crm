<div id="add_patient_dialog" class="dialog" title="Пациент">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">ФИО:</td>
            <td width="70%">
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;">
            </td>
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
            <td>Дата напр-я:</td>
            <td><input type="text" id="edit_dt_plan" value="{$data.dt_plan}" class="edit-dt" style="width: 30%;">&nbsp</td>
        </tr>
        <tr>
            <td>Диагноз </td>
            <td><textarea id="edit_diagnosis" rows="4" style="width: 98%;">{$data.diagnosis} </textarea></td>
        </tr>
        <tr>
            <td>МО ID:</td>
            <td><input type="text" id="edit_mo_id" value="{$data.mo_id}" style="width: 30%;" {if $mo_id_read == 1} readonly {/if}>&nbsp</td>
        </tr>
        <tr>
            <td>Дата 1-ой конс.:</td>
            <td><input type="text" id="edit_dt_consultion" value="{$data.dt_consultion}" readonly style="width: 30%;">&nbsp</td>
        </tr>
        <tr>
            <td>Комментарий </td>
            <td><textarea id="edit_comment" rows="4" style="width: 98%;">{$data.comment} </textarea></td>
        </tr>

    </table>
</div>




