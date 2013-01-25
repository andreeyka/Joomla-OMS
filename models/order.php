<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
$user =& JFactory::getUser();
if (!$user->guest)
{
	// 	���������� ����� JModel
	jimport('joomla.application.component.model');
	
	
	
	
	class OmsModelOrder extends JModel
	{
		private $_statuses;
		
		function __construct()
		{
			parent::__construct();
		}
		
		
		public function addorder($data)
		{
			
			$user =& JFactory::getUser();
			$table = $this->getTable("Oms");
			$data['user_id']=$user->id;
			$data['price']=str_replace(',','.',$data['price']);
			
			$data['site']=preg_replace('/http:\/\/anonymouse.org\/cgi-bin\/anon-www.cgi/', '', $data['item_url']);
			preg_match('/:\/\/([a-z0-9\.]+)\//i',$data['site'],$matches);
			$data['site']=$matches[1];
			
			if (!$table->bind($data))
			{
				$this->setError($table->getError());
				return false;
			}
			// ��������� ������
			if ($table->check($data))
			{
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
		
		public function getCurs()
		{
							
			$query 	= 'SELECT value'
					. ' FROM ' . $this->_db->nameQuote('#__ordermanagementsystem_settings')
					. ' where param="USD"';
			$this->_db->setQuery($query);
			$this->_statuses = $this->_db->loadObjectList();
			return $this->_statuses;
		}
		
	}
}