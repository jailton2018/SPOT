{include file = "partial_commons{$SYSTEM_PATH_SEPARATOR}_header.tpl"}
{include file = "partial_commons{$SYSTEM_PATH_SEPARATOR}_menu.tpl"}

{include file = "partial_commons{$SYSTEM_PATH_SEPARATOR}_errors.tpl"}


<p>{$LBL_0_no_untag_success_port_id} <b>{$port_id}</b> {$LBL_0_no_untag_success_switch} {$mySwitch->getName()} {$LBL_0_no_untag_success} <b>{$vlan_id}</b>.</p>

<div class="back-link"><p>
	<a href="list_vlans.php?switch_id={$mySwitch->getId()}">{$LBL_0_back}</a>
</p></div>

{include file = "partial_commons{$SYSTEM_PATH_SEPARATOR}_footer.tpl"}