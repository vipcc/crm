<div class="toolbar">
    <input type="button" class="click visit btn-add" value="внести визит" id="visit-showAddDialog">
    <input type="button" class="click visit btn-edit" value="править визит" id="visit-showEditDialog">
    <input type="button" class="click visit btn-read" value="смотреть визит" id="visit-showReadDialog">
    <input type="button" class="click visit btn-delete" value="удалить визит" id="visit-showDeleteDialog">
    <input type="button" class="click visit btn-confirm" value="подписать" id="visit-confirm">
    <input type="button" class="click visit btn-deconfirm" value="снять подпись" id="visit-deconfirm">

    <div style="float: right;">

        МП
        <select id="visit_filtr_manager" class="set-filtr" style="width: 200px;">
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
        На дату
        <input type="edit" id="visit_filtr_dt" value="{$today}" class="edit-dt set-filtr main-dt">
    </div>
</div>