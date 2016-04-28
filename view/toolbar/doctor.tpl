<div class="toolbar">
    <input type="button" class="click" value="добавить" id="doctor-showAddDialog-{$status}">
    <input type="button" class="click" value="редактировать" id="doctor-showEditDialog-{$status}">
    <input type="button" class="click" value="просмотр" id="doctor-showReadDialog-{$status}">
    <input type="button" class="click" value="удалить" id="doctor-showDeleteDialog-{$status}">

    <div style="float: right;">

        МП
        <select id="doctor_filtr_manager-{$status}" class="set-filtr" style="width: 200px;">
            {if $gid != 103}
                <option value="0"> все </option>
            {/if}

            {foreach $managers as $manager}
                {if $gid == 103}
                    {if $manager.id == $manager_id}
                        <option value="{$manager.id}" selected > {$manager.name} </option>
                    {/if}
                {else}
                    <option value="{$manager.id}"> {$manager.name} </option>
                {/if}
            {/foreach}
        </select>

        &nbsp &nbsp

    </div>
</div>