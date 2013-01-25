<?php
// защита от прямого доступа
defined('_JEXEC') or die('Restricted access');
$user =& JFactory::getUser();
if (!$user->guest)
{
	// 	подключаем класс JModel
	jimport('joomla.application.component.model');
	
	
	
	
	class OmsModelOmsadmin extends JModel
	{
		
		private $_order;
		private $_statuses;
	 
		/**
		 * Конструктор
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
				$POST = JRequest::get('post');
				if(isset($POST[filter_time]) && $POST[filter_time]!='') $filter[] = ' time like \'%'.$POST[filter_time].'%\' ';
				if(isset($POST[filter_user_id]) && $POST[filter_user_id]!='0') $filter[] = ' user_id = \''.$POST[filter_user_id].'\' ';
				if(isset($POST[filter_site]) && $POST[filter_site]!='0') $filter[] = ' item_url like \'%'.$POST[filter_site].'%\' ';
				if(isset($POST[filter_status]) && $POST[filter_status]!='0') $filter[] = ' status = \''.$POST[filter_status].'\' ';
				if(!isset($POST[filter_status])) $filter[] = ' status = \'1\' ';
				if (is_array($filter)) $filter=' where '.implode(' and ',$filter);
				
				
				$query 	= 'SELECT *'
					. ' FROM ' . $this->_db->nameQuote('#__ordermanagementsystem')
					. ' '.$filter
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
		
		public function saveorder($data)
		{
			$user =& JFactory::getUser();
			
			$table = $this->getTable();
		
			
			
			$data['user_id']=$user->id;
			
			#var_dump($data); die();
			
			// привязываем поля формы к таблице
			if (!$table->bind($data))
			{
				$this->setError($table->getError());
				return false;
			}
			// проверяем данные
			if ($table->check($data))
			{
				// сохраняем данные
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
}