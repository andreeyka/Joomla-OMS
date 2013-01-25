<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
// 	���������� ����� JModel
jimport('joomla.application.component.model');
	
	
	
	
class OmsModelOms extends JModel
{
	
	private $_order;
	private $_statuses;
 
	/**
	 * �����������
	 */
	function __construct()
	{
		parent::__construct();
	}
 
	public function getOrders()
	{
		$user =& JFactory::getUser();
		if (empty($this->_orders))
		{
			$query 	= 'SELECT *'
				. ' FROM ' . $this->_db->nameQuote('#__ordermanagementsystem')
				. ' WHERE `user_id` = '.$user->id
				. ' ORDER BY id';
			$this->_db->setQuery($query);
			$this->_orders = $this->_db->loadObjectList();
		}
 
		return $this->_orders;
	}
		
	public function getStatuses()
	{
		$user =& JFactory::getUser();
		#($user); die();
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
	
	public function add($data)
	{
		$user =& JFactory::getUser();
		$table = $this->getTable();
		$data['user_id']=$user->id;
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
	
	
	public function remove()
	{
		$table = $this->getTable();
		$cids = JRequest::getVar('cid', array(0), 'post', 'array');
	
		foreach ($cids as $cid) {
			if (!$table->delete($cid)) {
				$this->setError($table->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	
}