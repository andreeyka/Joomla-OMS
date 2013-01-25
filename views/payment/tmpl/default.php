<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');

$payment_date_form=@JHTML::calendar($payment_date,
				'payment_date',
				'payment_date',
				'%Y-%m-%d',
				array('class'=>'payment_date'));


?>
<form action="index.php?option=com_oms" method="post" name="adminForm" id="adminForm">
<table class="userOrderForm"><thead>
<tr class="cell">
<th colspan="2" class="header"><?php echo JText::_('OMS TITLE EDIT ORDER')?></th>
	</tr>
</thead><tfoot>
	<tr class="cell">
		<td colspan="2">
			<?php echo $this->getToolbar();?>
		</td>
	</tr>
</tfoot><tbody>
	<tr class="paymentFormRow">
		<td class="cell name oms_time"><?php echo JText::_('OMS PAYMENT DATE')?></td>
		<td class="cell input oms_time"><?php echo $payment_date_form;?></td>
	</tr>	

	<tr class="paymentFormRow">
		<td class="cell name oms_item_url"><?php echo JText::_('OMS PAYMENT VALUE')?></td>
		<td class="cell input oms_item_url"><input class="text_area" type="text" name="value" id="item_url" size="50" maxlength="500" value=""></td>
	</tr>
	<tr class="paymentFormRow">
		<td class="cell name oms_item_site"><?php echo JText::_('OMS PAYMENT NOTES')?></td>
		<td class="cell input oms_item_site"><input class="text_area" type="text" name="notes" id="site" size="50" maxlength="500" value=""></td>
	</tr>
	
</tbody></table>	
	
	<input type="hidden" name="task" value="">
	<?php echo JHTML::_('form.token'); ?>
	</form>
