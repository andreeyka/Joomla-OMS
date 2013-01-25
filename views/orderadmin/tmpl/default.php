<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');

$_CUR=32.5;
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
	<tr class="orderFormRow">
		<td class="cell name oms_time"><?php echo JText::_('OMS TIME')?></td>
		<td class="cell input oms_time"><input class="text_area" type="text" name="time" id="time" size="50" maxlength="50" value="<?php echo $this->row->time;?>"></td>
	</tr>	

	<tr class="orderFormRow">
		<td class="cell name oms_item"><?php echo JText::_('OMS ITEM')?></td>
		<td class="cell input oms_item"><input class="text_area" type="text" name="item" id="item" size="50" maxlength="500" value="<?php echo $this->row->item;?>"></td>
	</tr>
	
	<tr class="orderFormRow">
		<td class="cell name oms_item_url"><?php echo JText::_('OMS ITEMURL')?></td>
		<td class="cell input oms_item_url"><input class="text_area" type="text" name="item_url" id="item_url" size="50" maxlength="500" value="<?php echo $this->row->item_url;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_item_site"><?php echo JText::_('OMS ITEMURL')?></td>
		<td class="cell input oms_item_site"><input class="text_area" type="text" name="site" id="site" size="50" maxlength="500" value="<?php echo $this->row->site;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_article"><?php echo JText::_('OMS ARTICLE')?></td>
		<td class="cell input oms_article"><input class="text_area" type="text" name="article" id="article" size="50" maxlength="50" value="<?php echo $this->row->article;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_size"><?php echo JText::_('OMS SIZE')?></td>
		<td class="cell input oms_size"><input class="text_area" type="text" name="size" id="size" size="50" maxlength="50" value="<?php echo $this->row->size;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_color"><?php echo JText::_('OMS COLOR')?></td>
		<td class="cell input oms_color"><input class="text_area" type="text" name="color" id="color" size="50" maxlength="50" value="<?php echo $this->row->color;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_amount"><?php echo JText::_('OMS AMOUNT')?></td>
		<td class="cell input oms_amount"><input class="text_area" type="text" name="amount" id="amount" size="50" maxlength="50" value="<?php echo $this->row->amount;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_price"><?php echo JText::_('OMS PRICE')?></td>
		<td class="cell input oms_price"><input class="text_area" type="text" name="price" id="price" size="50" maxlength="50" value="<?php echo $this->row->price;?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_currency"><?php echo JText::_('OMS CURRENCY')?></td>
		<td class="cell input oms_currency"><input class="text_area" type="text" name="currency" id="currency" size="50" maxlength="50" value="<?php echo $this->row->currency;?>">
</td>
	</tr>
	
	<tr class="orderFormRow">
		<td class="cell name oms_currency"><?php echo JText::_('OMS CURRENCY RATE')?></td>
		<td class="cell input oms_currency"><input class="text_area" type="text" name="currency_rate" id="currency_rate" size="50" maxlength="50" value="<?php echo $this->row->currency_rate;?>">
</td>
	</tr>
	
	
	
	<tr class="orderFormRow">
		<td class="cell name oms_currency"><?php echo strip_tags(JText::_('OMS TAX'))?></td>
		<td class="cell input oms_currency"><input class="text_area" type="text" name="tax" id="tax" size="50" maxlength="50" value="<?php echo $this->row->tax;?>">
</td>
	</tr>
	
	
	<tr class="orderFormRow">
		<td class="cell name oms_currency"><?php echo strip_tags(JText::_('OMS INTEREST'))?></td>
		<td class="cell input oms_currency"><input class="text_area" type="text" name="interest" id="inetrest" size="50" maxlength="50" value="<?php echo $this->row->interest;?>">
</td>
	</tr>
	
	<tr class="orderFormRow">
		<td class="cell name oms_currency"><?php echo strip_tags(JText::_('OMS WEIGHT'))?></td>
		<td class="cell input oms_currency"><input class="text_area" type="text" name="weight" id="weight" size="50" maxlength="50" value="<?php echo $this->row->weight;?>">
</td>
	</tr>
	
	
	<tr class="orderFormRow">
		<td class="cell name oms_notes"><?php echo JText::_('OMS NOTES')?></td>
		<td class="cell input oms_notes"><input class="text_area" type="text" name="notes" id="notes" size="50" maxlength="50" value="<?php echo $this->row->notes; ?>"></td>
	</tr>
	<tr class="orderFormRow">
		<td class="cell name oms_notes"><?php echo JText::_('OMS STATUS')?></td>
		<td class="cell input oms_notes">
		<?php echo JHTML::_('select.genericlist', $this->getStatuses(), 'status', 'class="inputbox"', 'value', 'text', $this->row->status);?>
		</td>
	</tr>
	
</tbody></table>	
	
	
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>">
	<input type="hidden" name="user_id" value="<?php echo $this->row->user_id; ?>">
	<input type="hidden" name="task" value="">
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHTML::_('form.token'); ?>
	</form>

