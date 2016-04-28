<div class="toolbar">
    Период
    <input type="edit" value="" class="edit-dt set-filtr" id="reppatient_filtr_dt_start"> -
    <input type="edit" value="" class="edit-dt set-filtr" id="reppatient_filtr_dt_end"> &nbsp &nbsp &nbsp


    Врач
    <select id="reppatient_filtr_doctor" style="width: 200px;" class="set-filtr">
        <option value="0">все</option>
        {foreach $doctors as $doctor}
            <option value="{$doctor.id}" {if $doctor.id == $data.doctor} selected {/if}> {$doctor.name} </option>
        {/foreach}
    </select>

    &nbsp &nbsp &nbsp

    Менеджер
    <select id="reppatient_filtr_manager" style="width: 200px;" class="set-filtr">
        <option value="0">все</option>
        {foreach $managers as $manager}
            <option value="{$manager.id}" {if $manager.id == $data.manager} selected {/if}> {$manager.name} </option>
        {/foreach}
    </select>

    <div style="float: right;">
        Всего: <span id="reppatient-total" class="total"> 0 </span> записей
    </div>

</div>