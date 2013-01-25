<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
// ���������� ����� JView
jimport('joomla.application.component.view');
 
class OmsViewOrderadmin extends Jview
{
	function display($tpl = null)
	{
		$row = JTable::getInstance('Oms', 'Table');
		$cid = JRequest::getVar('cid', array(0), '', 'array');
		$id = (int)$cid[0];
		if (isset($id)) {
			$row->load($id);
		}
		// присваиваем значение виду
		$this->assignRef('row', $row);
		
		parent::display($tpl);
	}
	
	/*function getSelect (&$array,&$name)
	{
		foreach ($array as $i=>$v):
			$output[] = array('value' => $i, 	'text' => $v);
		endforeach;
		return(JHTML::_('select.genericlist', $output, $name, 'class="inputbox"'));
	}
	*/
	function getStatuses ()
	{
		$statuses = &$this->get('Statuses');
		foreach ($statuses as $i):
		$statuses_array[(int)$i->id] = $i->status;
		endforeach;
	
		return $statuses_array;
	}
	
	function getToolbar() {
		$document    = & JFactory::getDocument();
		jimport('joomla.html.toolbar');
		$bar =& new JToolBar( 'toolbar' );
		$bar->appendButton( 'Standard', 'save', JText::_('OMS EDIT ORDER'), 'saveorder', false );
		$bar->appendButton( 'Standard', 'cancel', JText::_('OMS CANCEL'), '', false );
		return $bar->render();
	}
	
}
