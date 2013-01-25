<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');
// 	���������� ����� JModel
jimport('joomla.application.component.model');
	
	
	
	
class omsModelPayments  extends JModel
{
	
	private $_payments;
	private $_statuses;
 
	/**
	 * �����������
	 */
	function __construct()
	{
		parent::__construct();
	}
 
	public function getPayments()
	{
		$user =& JFactory::getUser();
		if (empty($this->_payments))
		{
			$query 	= 'SELECT *'
				. ' FROM ' . $this->_db->nameQuote('#__ordermanagementsystem_payments')
				. ' WHERE `user_id` = '.$user->id
				. ' ORDER BY time';
			$this->_db->setQuery($query);
			$this->_payments = $this->_db->loadObjectList();
		}
 
		return $this->_payments;
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
	
	public function addpayment($data)
	{
		$user =& JFactory::getUser();
		$table = $this->getTable('Payments');
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