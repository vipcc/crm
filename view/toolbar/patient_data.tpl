
        Врач
        <select id="patient_filtr_doctor" class="set-filtr" style="width: 200px;">
            {foreach $doctors as $doctor}
                {if $gid == 103}
                    {if $doctor.id == $doctor_id}
                        <option value="{$doctor.id}" selected > {$doctor.name} </option>
                    {/if}
                {else}
                    <option value="{$doctor.id}"> {$doctor.name} </option>
                {/if}
            {/foreach}
        </select>

        &nbsp &nbsp
