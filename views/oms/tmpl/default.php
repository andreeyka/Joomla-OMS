	<?php 
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');

$user =& JFactory::getUser();


#$_CUR=32.5;

$htmltable = new JGrid($options = array('class'=>'userOrderlist'));
$htmltable->addRow($options = array('class'=>'header'),1);
$showcolumn=array(
		time	=>	JText::_('OMS TIME'),
		item	=>	JText::_('OMS ITEM'),
		#item_url=>	JText::_('OMS ITEMURL'),
		#article	=>	JText::_('OMS ARTICLE'),
		params	=>	JText::_('OMS PARAMS'),
		#size	=>	JText::_('OMS SIZE'),
		#color	=>	JText::_('OMS COLOR'),
		amount	=>	JText::_('OMS AMOUNT'),
		price	=>	JText::_('OMS PRICE'),
		#currency=>	JText::_('OMS CURRENCY'),
		interestandtax=>	JText::_('OMS TAX').'<br>'.JText::_('OMS INTEREST'),
		#interest=>	JText::_('OMS INTEREST'),
		#tax		=> JText::_('OMS TAX'),
		price_r	=>	JText::_('OMS PRICE_R'),
		
		#weight	=>	JText::_('OMS WEIGHT'),
		#notes	=>	JText::_('OMS NOTES'),
		status	=>	JText::_('OMS STATUS')
);

foreach ($showcolumn as $h_id => $header):
	$htmltable->addColumn($h_id);
	$htmltable->setRowCell($h_id, $header, $option = array('class'=>'header oms_'.$h_id));
endforeach;

#var_dump($this->rows);

foreach ($this->rows as $row_id => $row):
	
	$htmltable->addRow($options = array('class'=>'omsItemRow'.($i % 2).' orderStatus'.$row->status));
	foreach ($row as $name => $value):
		$htmltable->setRowCell($name, $value,$option = array('class'=>'cell oms_'.$name));
	endforeach;

	
	$price = $row->amount*$row->price*$row->currency_rate*($row->tax/100+1);
	$price = round($price*($row->interest/100+1),2);
	$total += $price;
	$count++;

	
	$htmltable->setRowCell('params','<b>'.JText::_('OMS ARTICLE').':</b>  '.$row->article
			.'<br><b>'.JText::_('OMS SIZE').':</b>  '.$row->size
			.'<br><b>'.JText::_('OMS COLOR').':</b>  '.$row->color
			,$option = array('class'=>'cell oms_params'));
	
	$htmltable->setRowCell('price',$row->price.'<br>('.$row->currency.')<br>('.$row->currency_rate.')',$option = array('class'=>'cell oms_price'));
	$htmltable->setRowCell('item', JHtml::link($row->item_url,$row->item.'<br>'.substr($row->item_url,0,30), array('target'=>'blank')),$option = array('class'=>'cell oms_status'));
	$htmltable->setRowCell('status', $this->getStatus($row->status),$option = array('class'=>'cell oms_status'));
	$htmltable->setRowCell('price_r',$price,$option = array('class'=>'cell oms_price_r'));
	$htmltable->setRowCell('interestandtax',$row->tax.'%<br>'.$row->interest.'%',$option = array('class'=>'cell oms_interestandtax'));
endforeach;

if (!$user->guest)
{	
	
	
	echo '<span class="orderTotal">'.JText::_('OMS ORDEROV').$count.JText::_('OMS NA SUMMU').$total.JText::_('OMS RUB.').' </span>';
	
	?>
	
	<form action="/joomla/index.php?option=com_oms" method="post" id="adminForm" name="adminForm">
		<?php echo $this->getToolbar();?>
		<?php echo $htmltable->toString();?>
		<input type="hidden" name="task" value="" />
		<input type = "hidden" name = "option" value = "com_oms" />
	</form>
<?php 
}
?>