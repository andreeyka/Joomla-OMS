<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');

$CUR=32.5;


$htmltable = new JGrid($options = array('class'=>'userOrderForm'));
$htmltable->addRow($options = array('class'=>'cell'), 1);
$htmltable->addColumn('name');
$htmltable->addColumn('input');
$htmltable->setRowCell('name', JText::_('OMS LOGIN FROM HEADER'), $option = array('colspan'=>'2', 'class'=>'header'));


$showrow=array(
		item	=>	JText::_('OMS ITEM'),
		item_url=>	JText::_('OMS ITEMURL'),
		article	=>	JText::_('OMS ARTICLE'),
		size	=>	JText::_('OMS SIZE'),
		color	=>	JText::_('OMS COLOR'),
		amount	=>	JText::_('OMS AMOUNT'),
		price	=>	JText::_('OMS PRICE'),
		currency=>	JText::_('OMS CURRENCY'),
		notes	=>	JText::_('OMS NOTES')
);

foreach ($showrow as $input => $name):
	$htmltable->addRow($options = array('class'=>'orderFormRow'));
	$htmltable->setRowCell('name', $name, $option = array('class'=>'cell name oms_'.$input));
	
	switch ($input) {
		case 'currency':
			$h_input = $this->getSelect($a=array('USD'=>'USD('.$this->getCurs().')'),$input);
		break;
		case 'item_url':
			$h_input='<input class="text_area" type="text" name="'.$input.'" id="'.$input.'" size="50" maxlength="500" value="" />';
			break;
		default:
			$h_input='<input class="text_area" type="text" name="'.$input.'" id="'.$input.'" size="50" maxlength="50" value="" />';
	}
	
	$htmltable->setRowCell('input',$h_input, $option = array('class'=>'cell input oms_'.$input));
endforeach;

$htmltable->addRow($options = array('class'=>'cell'), 2);
$htmltable->setRowCell('name', $this->getToolbar(), $option = array('colspan'=>'2'));


?>
<form action="index.php?option=com_oms" method="post" name="adminForm" id="adminForm">
	<?php echo $htmltable->toString();?>
	<input type="hidden" name="option" value="com_oms" />
	<input type="hidden" name="currency_rate" value="<?php echo $this->getCurs(); ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
</form>