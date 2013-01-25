<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.grid');


jimport('joomla.html.grid');

$user =& JFactory::getUser();

$htmltable = new JGrid($options = array('class'=>'userPaymentlist'));

$htmltable->addColumn('date');
$htmltable->addColumn('user_id');
$htmltable->addColumn('value');
$htmltable->addColumn('notes');
$htmltable->addColumn('status');

$htmltable->addRow($options = array('class'=>'header'),1);

$htmltable->setRowCell('date', 'date', $option = array('class'=>'header oms_'));
$htmltable->setRowCell('user_id', 'user_id', $option = array('class'=>'header oms_'));
$htmltable->setRowCell('value', 'value', $option = array('class'=>'header oms_'));
$htmltable->setRowCell('notes', 'notes', $option = array('class'=>'header oms_'));
$htmltable->setRowCell('status', 'status', $option = array('class'=>'header oms_'));


foreach ($this->rows as $id => $row):
	$htmltable->addRow($options = array('class'=>'paymentRow'),1);
	$htmltable->setRowCell('date', $row->payment_date, $option = array('class'=>'cell oms_'));
	$htmltable->setRowCell('user_id', $row->user_id, $option = array('class'=>'cell oms_'));
	$htmltable->setRowCell('value', $row->value, $option = array('class'=>'cell oms_'));
	$htmltable->setRowCell('notes', $row->notes, $option = array('class'=>'cell oms_'));
	$htmltable->setRowCell('status', $row->status, $option = array('class'=>'cell oms_'));
endforeach;


echo $htmltable->toString();
?>