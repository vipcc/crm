<div class="toolbar">
    <input type="button" class="click" value="добавить" id="patient-showAddDialog-{$status}">
    <input type="button" class="click" value="редактировать" id="patient-showEditDialog-{$status}">
    <input type="button" class="click" value="просмотр" id="patient-showReadDialog-{$status}">
    <input type="button" class="click" value="удалить" id="patient-showDeleteDialog-{$status}"> &nbsp

    <div style="float: right;">
        Врач
        <select id="patient_filtr_doctor-{$status}" class="set-filtr" style="width: 200px;">
            {if $gid != 103}
                <option value="0"> все </option>
            {/if}

            {foreach $doctors as $doctor}
                    <option value="{$doctor.id}"> {$doctor.name} </option>
            {/foreach}
        </select>


    </div>
</div>