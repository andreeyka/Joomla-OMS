<?php 
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');
ini_set('display_errors',1);
error_reporting(E_ALL);
$user =& JFactory::getUser();



$revenue = 0;
$total = 0;
$count = 0;

$POST = JRequest::get('post');

@$filter_time = $POST[filter_time] ? $POST[filter_time] : '';
@$filter_user_id = $POST[filter_user_id] ? $POST[filter_user_id] : '0'; 
@$filter_site = $POST[filter_site] ? $POST[filter_site] : '0';
@$filter_status = $POST[filter_status] ? $POST[filter_status] : '0';

if(!@isset($POST[filter_status])) @$filter_status = '1';

if(@isset($POST[filter_time]) && @$POST[filter_time]!='') $filter[] = ' time like \'%'.@$POST[filter_time].'%\' ';
if(@isset($POST[filter_user_id]) && @$POST[filter_user_id]!='0') $filter[] = ' user_id = \''.@$POST[filter_user_id].'\' ';
if(@isset($POST[filter_status]) && @$POST[filter_status]!='0') $filter[] = ' status = \''.@$POST[filter_status].'\' ';
if(!@isset($POST[filter_status])) $filter[] = ' status = \'1\' ';
if (@is_array($filter)) $filter=' where '.implode(' and ',$filter);


$htmltable = new JGrid($options = array('class'=>'userOrderlist'));
$htmltable->addRow($options = array('class'=>'header'),1);

@$showcolumn=array(
		checked	=>	' ',
		time	=>	JText::_('OMS TIME'),
		user_id	=>	JText::_('OMS USERNAME'),
		item	=>	JText::_('OMS ITEM'),
		#item_url=>	JText::_('OMS ITEMURL'),
		params	=>	JText::_('OMS PARAMS'),
		#article	=>	JText::_('OMS ARTICLE'),
		#size	=>	JText::_('OMS SIZE'),
		#color	=>	JText::_('OMS COLOR'),
		amount	=>	JText::_('OMS AMOUNT'),
		price	=>	JText::_('OMS PRICE'),
		#currency=>	JText::_('OMS CURRENCY'),
		interestandtax=>	JText::_('OMS TAX').'<br>'.JText::_('OMS INTEREST'),
		#tax		=>	JText::_('OMS TAX'),
		#interest=>	JText::_('OMS INTEREST'),
		price_r	=>	JText::_('OMS PRICE_R'),
		#notes	=>	JText::_('OMS NOTES'),
		status	=>	JText::_('OMS STATUS')
);

foreach ($showcolumn as $h_id => $header):
	$htmltable->addColumn($h_id);
	$htmltable->setRowCell($h_id, $header, $option = array('class'=>'header oms_'.$h_id));
endforeach;


$htmltable->addRow($options = array('class'=>'filter'));
$htmltable->setRowCell('checked', '-', $option = array('class'=>'omsfilter oms_user_id'));


$htmltable->setRowCell('time', 
						JHTML::calendar($filter_time,
										'filter_time',
										'filter_time',
										'%Y-%m-%d',
										array('class'=>'form_filter data','size'=>'20', 'onchange'=>'Joomla.submitbutton(\'adminfilter\')')), 
						$option = array('class'=>'omsfilte oms_user_id'));



$htmltable->setRowCell('user_id', 
						JHTML::_(	'select.genericlist', 
									JHTML::_('list.genericordering', 
											'SELECT id AS value, username AS text FROM #__users order by username asc'
											), 
									'filter_user_id', 
									array('class'=>'form_filter data', 'onchange'=>'Joomla.submitbutton(\'adminfilter\')'),
									'value',
									'text',
									$filter_user_id), 
						array('class'=>'omsfilter oms_user_id'));


$htmltable->setRowCell(	'item', 
						JHTML::_(	'select.genericlist', 
									JHTML::_('list.genericordering', 
											'SELECT site AS value, concat(site,". '.JText::_('OMS ORDEROV').' - ",count(site)) as text FROM #__ordermanagementsystem '.@$filter.' group by site order by site asc', 
											'40'), 
									'filter_site',
								array('class'=>'form_filter item', 'onchange'=>'Joomla.submitbutton(\'adminfilter\')'),
								'value',
								'text',
								$filter_site), 
						$option = array('class'=>'omsfilter oms_item'));



$htmltable->setRowCell('params', '-', $option = array('class'=>'omsfilter oms_user_id'));
$htmltable->setRowCell('amount', '-', $option = array('class'=>'omsfilter oms_user_id'));
$htmltable->setRowCell('price', '-', $option = array('class'=>'omsfilter oms_user_id'));
$htmltable->setRowCell('interestandtax', '-', $option = array('class'=>'omsfilter oms_user_id'));
$htmltable->setRowCell('price_r', '-', $option = array('class'=>'omsfilter oms_user_id'));

$htmltable->setRowCell(	'status', 
						JHTML::_('select.genericlist', 
								JHTML::_('list.genericordering', 
										'SELECT id AS value, status as text FROM #__ordermanagementsystem_statuses order by id asc'
										), 
								'filter_status',
								array('class'=>'form_filter status', 'onchange'=>'Joomla.submitbutton(\'adminfilter\')'),
								'value',
								'text',
								$filter_status), 
						array('class'=>'omsfilte oms_user_id'));




foreach ($this->rows as $row_id => $row):
	


	$htmltable->addRow($options = array('class'=>'omsItemRow'.($row->id % 2).' orderStatus'.$row->status));

	$row->checked='<input type="checkbox" id="cb" name="cid[]" value="'.$row->id.'" onclick="Joomla.isChecked(this.checked);" title="JGRID_CHECKBOX_ROW_N">';
	foreach ($row as $name => $value):
		$htmltable->setRowCell($name, $value,$option = array('class'=>'cell oms_'.$name));
	endforeach;
	$price = $row->amount*$row->price*$row->currency_rate*($row->tax/100+1);
	$revenue += round($price*$row->interest/100,2); 
	$price = round($price*($row->interest/100+1),2);
	$total += $price;
	$count++;
	$username =& JFactory::getUser($row->user_id);
	$htmltable->setRowCell('params','<b>'.JText::_(	'OMS ARTICLE').':</b>'.$row->article
												.'<br><b>'.JText::_('OMS SIZE').':</b>'.$row->size
												.'<br><b>'.JText::_('OMS COLOR').':</b>'.$row->color
	,$option = array('class'=>'cell oms_params'));
	$htmltable->setRowCell('user_id',JHtml::link('index.php?option=com_oms&view=orderadmin&cid[]='.$row->id,$username->username),$option = array('class'=>'cell oms_user_id'));
	$htmltable->setRowCell('time', JHtml::link('index.php?option=com_oms&view=orderadmin&cid[]='.$row->id,$row->time),$option = array('class'=>'cell oms_time'));
	$htmltable->setRowCell('item', JHtml::link($row->item_url,$row->item.'<br>'.substr($row->item_url,0,30), array('target'=>'blank')),$option = array('class'=>'cell oms_status'));
	$htmltable->setRowCell('status', $this->getStatus($row->status),$option = array('class'=>'cell oms_status'));
	$htmltable->setRowCell('price_r',$price.'<br>('.JText::_('OMS RUB').')',$option = array('class'=>'cell oms_price_r'));
	$htmltable->setRowCell('price',$row->price.'<br>('.$row->currency.')<br>('.$row->currency_rate.')',$option = array('class'=>'cell oms_price_r'));
	$htmltable->setRowCell('interestandtax',$row->tax.'%<br>'.$row->interest.'%',$option = array('class'=>'cell oms_interestandtax'));
endforeach;

if (!$user->guest)
{	
	
	
	echo '<span class="orderTotal">'.JText::_('OMS ORDEROV').$count.JText::_('OMS NA SUMMU').$total.JText::_('OMS RUB.').' '.JText::_('OMS INTEREST').' - '.$revenue.JText::_('OMS RUB.').'</span>';
	
	?>
	
	<form action="/joomla/index.php?option=com_oms&view=omsadmin" method="post" id="adminForm" name="adminForm">
		<?php echo $this->getToolbar();?>
		
		
		
		<?php echo $htmltable->toString();?>
		<input type="hidden" name="task" value="" />
		<input type = "hidden" name = "option" value = "com_oms" />
		<input type="hidden" name="boxchecked" value="0" />
	</form>
	
	
	
	
<?php 
}
?>