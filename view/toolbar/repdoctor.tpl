<div class="toolbar">
    Период
    <input type="edit" value="" class="edit-dt set-filtr" id="repdoctor_dt_start"> -
    <input type="edit" value="" class="edit-dt set-filtr" id="repdoctor_dt_end"> &nbsp &nbsp &nbsp
    Специализация
    <select id="repdoctor_filtr_special" style="width: 200px;" class="set-filtr">
        <option value="0"></option>
        {foreach $specials as $special}
            <option value="{$special.id}" {if $special.id == $data.special} selected {/if}> {$special.name} </option>
        {/foreach}
    </select>
    &nbsp
    ЛУ
    <select id="repdoctor_filtr_clinic" style="width: 200px;" class="set-filtr">
        <option value="0"></option>
        {foreach $clinics as $clinic}
            <option value="{$clinic.id}" {if $clinic.id == $data.clinic} selected {/if}> {$clinic.name} </option>
        {/foreach}
    </select>

    <div style="float: right;">
        Всего: <span id="repdoctor-total" class="total"> 0 </span> записей
    </div>
</div>