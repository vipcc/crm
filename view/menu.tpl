<div id="part_div">
    <select id="ShowPage">

        {foreach $menu as $item}
            <option id="{$item.2}" value="{$item.0}" {if $item.0 == $selected} selected {/if}> {$item.1} </option>

        {/foreach}

    </select>

</div>