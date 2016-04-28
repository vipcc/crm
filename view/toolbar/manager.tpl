<div class="toolbar">
    <input type="button" class="click btn-add" value="добавить" id="manager-showAddDialog">
    <input type="button" class="click btn-edit" value="редактировать" id="manager-showEditDialog">
    <input type="button" class="click btn-delete" value="удалить" id="manager-showDeleteDialog">

    <div style="float: right;">

        Регион
        <select id="manager_filtr_region" style="width: 200px;" class="set-filtr">
            <option value="0">все</option>
            {foreach $regions as $region}
                <option value="{$region.id}" {if $region.id == $data.region} selected {/if}> {$region.name} </option>
            {/foreach}
        </select>
        На дату
        <input type="edit" id="manager_filtr_dt" value="{$today}" class="edit-dt set-filtr main-dt">
    </div>

</div>