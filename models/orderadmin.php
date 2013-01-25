<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
$user =& JFactory::getUser();
if (!$user->guest)
{
	// 	���������� ����� JModel
	jimport('joomla.application.component.model');
	
	
	
	
	class OmsModelOrderadmin extends JModel
	{
		private $_statuses;
		
		function __construct()
		{
			parent::__construct();
		}
		
		
		public function editorder($data)
		{
			
			$table = $this->getTable("Oms");
			
			if (!$table->bind($data))
			{
				$this->setError($table->getError());
				return false;
			}
			// ��������� ������
			if ($table->check($data))
			{
				// ��������� ������
				if (!$table->store($data))
				{
					$this->setError($table->getError());
					return false;
				}
			}
			else
			{
				$this->setError($table->getError());
				return false;
			}
		
			return true;
		}
		
		
		public function getStatuses()
		{
			$user =& JFactory::getUser();
			
			if (empty($this->_statuses))
			{
				$query 	= 'SELECT *'
						. ' FROM ' . $this->_db->nameQuote('#__ordermanagementsystem_statuses')
						. ' ORDER BY id';
				$this->_db->setQuery($query);
				$this->_statuses = $this->_db->loadObjectList();
			}
				
			return $this->_statuses;
		}
		
	}
}