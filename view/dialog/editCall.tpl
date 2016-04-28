<div id="add_call_dialog" class="dialog" title="Звонок">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="30%">Номер звонящего:</td>
            <td width="70%">
                <input type="text" id="edit_callerCID" value="{$data.callerCID}" style="width: 50%;" readonly>
            </td>
        </tr>
        <tr>
            <td>ФИО звонящего:</td>
            <td><input type="text" id="edit_name" value="{$data.name}" style="width: 98%;"></td>
        </tr>
        <tr>
            <td>ФИО пациента:</td>
            <td><input type="text" id="edit_patient_name" value="{$data.patient_name}" style="width: 98%;"></td>
        </tr>
        <tr>
            <td>Направил врач:</td>
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
            <td>Комментарий:</td>
            <td><textarea id="edit_comment" rows="7" style="width: 98%;">{$data.comment} </textarea>&nbsp</td>
        </tr>


    </table>
</div>




