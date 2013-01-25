<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
// ���������� ����� JView
jimport('joomla.application.component.view');
 
class OmsViewOrder extends Jview
{
	function display($tpl = null)
	{
			parent::display($tpl);
	}
	
	function getSelect (&$array,&$name)
	{
		foreach ($array as $i=>$v):
			$output[] = array('value' => $i, 	'text' => $v);
		endforeach;
		return(JHTML::_('select.genericlist', $output, $name, 'class="inputbox"'));
	}
	
	function getToolbar() {
		$document    = & JFactory::getDocument();
		jimport('joomla.html.toolbar');
		$bar =& new JToolBar( 'toolbar' );
		$bar->appendButton( 'Standard', 'save', JText::_('OMS PLACE ORDER'), 'addorder', false );
		$bar->appendButton( 'Standard', 'cancel', JText::_('OMS CANCEL'), '', false );
		return $bar->render();
	}
	function getCurs() {
		$curency = &$this->get('Curs');
		$a=$curency[0];
		return $a->value;
		
	}
	
	
}
