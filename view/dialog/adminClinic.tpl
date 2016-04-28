<div id="admin_clinic_dialog" class="dialog" title="Лечебные учреждения">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="40%" rowspan="2"><span id="admin_clinic_list">
                <select id="edit_clinic" style="width: 98%;" multiple size="15" class="dict-select">
                    {foreach $clinics as $clinic}
                        <option value="{$clinic.id}" {if $clinic.id == $data.clinic} selected {/if}>{$clinic.name}</option>
                    {/foreach}
                </select>
                </span>
            </td>
            <td width="60%">&nbsp Регион:<br>
                <select id="edit_region" style="width: 98%;">
                    {foreach $regions as $region}
                        <option value="{$region.id}" {if $region.id == $data.region} selected {/if}>{$region.name}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td width="60%">&nbsp Название:<br>
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;" class="dict-item">
            </td>
        </tr>
    </table>
</div>




