<?php
//
defined('_JEXEC') or die('Restricted access');
//
jimport('joomla.application.component.view');


class omsViewpayments extends JView
{
	function display($tpl = null)
	{
		$rows = $this->get('Payments');
		$this->assignRef('rows', $rows);
		parent::display($tpl);
	}
	
	function getToolbar() {
 				$document    = & JFactory::getDocument();
                jimport('joomla.html.toolbar');
                $bar =& new JToolBar( 'toolbar' );
                $bar->appendButton( 'Standard', 'new', JText::_('OMS ADD ITEM'), 'add', false );
                return $bar->render();
    }
	
}