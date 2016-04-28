<select id="edit_user" style="width: 98%;" multiple size="15" class="dict-select">
    {foreach $records as $record}
        <option value="{$record.id}" {if $record.id == $data.record} selected {/if}> {$record.name} </option>
    {/foreach}
</select>