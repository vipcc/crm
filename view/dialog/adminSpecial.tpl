<div id="admin_special_dialog" class="dialog" title="Специализации">
    <table cellspacing="0" style="border: 0px;" width="100%">

        <tr>
            <td width="40%" rowspan="1"><span id="admin_special_list">
                <select id="edit_special" style="width: 98%;" multiple size="15" class="dict-select">
                    {foreach $specials as $special}
                        <option value="{$special.id}" {if $special.id == $data.special} selected {/if}>{$special.name}</option>
                    {/foreach}
                </select>
                </span>
            </td>

            <td width="60%">&nbsp Название:<br>
                <input type="hidden" id="edit_id" value="{$data.id}">
                <input type="text" id="edit_name" value="{$data.name}" style="width: 98%;" class="dict-item">
            </td>
        </tr>
    </table>
</div>




