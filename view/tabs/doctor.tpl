<div id="s_tabs" class="tabs">
    <ul class="menu-tabs" style="background:#336699;">
        {foreach $tabs as $tab}
            <li><a id="{$tab.name}" class="menu-title" href="#{$tab.div}">{$tab.title}</a></li>
        {/foreach}
        {include file='menu.tpl'}
    </ul>

    {foreach $tabs as $tab}
        {assign var=status value=$tab.ind}
        <div id="{$tab.div}" class="div-tab">
            {include file=$tab.tbl}
            {include file=$tab.toolbar}
        </div>
    {/foreach}

</div>
