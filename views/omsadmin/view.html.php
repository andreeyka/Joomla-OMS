<?php
//
defined('_JEXEC') or die('Restricted access');
//
jimport('joomla.application.component.view');


class OmsViewOmsadmin extends JView
{
	function display($tpl = null)
	{
		$rows = $this->get('Orders');
		$this->assignRef('rows', $rows);
		parent::display($tpl);
	}
	
	function getStatuses ()
	{
		$statuses = &$this->get('Statuses');
		foreach ($statuses as $i):
			$statuses_array[(int)$i->id] = $i->status;
		endforeach;
		
		return $statuses_array;
	}
	
	function getStatus (&$id=1)
	{
		$status = &$this->getStatuses();
		return $status[$id];
		
	}
	
	/*function getSelect (&$id)
	{
		$statuses = $this->get('Statuses');
		$statuses_html = array (array('value' => 0, 	'text' => '- status -'));
		foreach ($statuses as $i):
			$statuses_html[] = array('value' => (int)$i->id, 	'text' => $i->status);
		endforeach;
		return(JHTML::_('select.genericlist', $statuses_html, 'status', 'class="inputbox"', 'value', 'text', $id));
	}*/
	
	
 	function getToolbar() {
                // add required stylesheets from admin template
 				$document    = & JFactory::getDocument();
                jimport('joomla.html.toolbar');
                $bar =& new JToolBar( 'toolbar' );
                $bar->appendButton( 'Standard', 'edit', JText::_('OMS EDIT ITEM'), 'editorder', false );
                $bar->appendButton( 'Standard', 'delete', JText::_('OMS DELETE ITEM'), 'deleteorder', false );
                return $bar->render();
    }
	
}