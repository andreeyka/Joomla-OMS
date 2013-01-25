<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
// ���������� ����� JView
jimport('joomla.application.component.view');

ini_set('display_errors',1);
error_reporting(E_ALL);

class omsViewpayment extends Jview
{
	function display($tpl = null)
	{
			parent::display($tpl);
	}
	
	
	
	function getToolbar() {
		$document    = & JFactory::getDocument();
		jimport('joomla.html.toolbar');
		$bar =& new JToolBar( 'toolbar' );
		$bar->appendButton( 'Standard', 'save', JText::_('OMS PLACE PAYMENT'), 'addpayment', false );
		$bar->appendButton( 'Standard', 'cancel', JText::_('OMS CANCEL'), '', false );
		return $bar->render();
	}
	
	
	
}
