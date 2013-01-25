<?php
//
defined('_JEXEC') or die('Restricted access');
//
jimport('joomla.application.component.view');


class OmsViewOms extends JView
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
	
	function getToolbar() {
 				$document    = & JFactory::getDocument();
                jimport('joomla.html.toolbar');
                $bar =& new JToolBar( 'toolbar' );
                $bar->appendButton( 'Standard', 'new', JText::_('OMS ADD ITEM'), 'add', false );
                return $bar->render();
    }
	
}