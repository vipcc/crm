
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
