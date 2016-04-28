{foreach $contact_list as $contact name=loop}
    {assign var="ind" value=$smarty.foreach.loop.iteration}
    <select id="tp_phone{$ind}" style="width: 25%;">
        <option value="1" {if $contact.tp == 1} selected {/if} > моб. </option>
        <option value="2" {if $contact.tp == 2} selected {/if}> раб. </option>
        <option value="3" {if $contact.tp == 3} selected {/if}> дом. </option>
        <option value="4"{if $contact.tp == 4} selected {/if} > факс. </option>
    </select>
    <input type="text" class="phone" id="phone{$ind}" value="{$contact.name}" style="width: 50%;"> <br>
{/foreach}

