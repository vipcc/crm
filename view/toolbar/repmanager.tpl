<div class="toolbar">
    Период
    <input type="edit" value="" class="edit-dt set-filtr" id="repmanager_filtr_dt_start"> -
    <input type="edit" value="" class="edit-dt set-filtr" id="repmanager_filtr_dt_end"> &nbsp &nbsp &nbsp


    Регион
    <select id="repmanager_filtr_region" style="width: 200px;" class="set-filtr">
        <option value="0">все</option>
        {foreach $regions as $region}
            <option value="{$region.id}" {if $region.id == $data.region} selected {/if}> {$region.name} </option>
        {/foreach}
    </select>

    <div style="float: right;">
        Всего: <span id="repmanager-total" class="total"> 0 </span> записей
    </div>

</div>