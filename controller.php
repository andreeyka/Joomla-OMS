<?php
// ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');

// ���������� ����� JController
$user =& JFactory::getUser();
if (!$user->guest)
{
	jimport('joomla.application.component.controller');
	class OmsController extends JController
	{
		/**
		 * �����������
		 */
	 
		
		function __construct()
		{
			parent::__construct();
		}
	 
		/**
		 * �������� ��� ����������� MVC view �����
		 */
		public function display()
		{
			parent::display();
		}
		
		public function deleteorder()
		{
			$model = $this->getModel('oms');
	 
			if ($model->remove())
			{
					$message = JText::_('DELETE OK');
			}
			else
			{
					$message = JText::_('DELETE FAILED');
					$message .= '['.$model->getError().']'; // �������� ������ �� ������
			}
			$this->setRedirect('index.php?option=com_oms&view=omsadmin', $message);
		}
		
		public function add()
		{
			JRequest::setVar('view', 'order');
			$this->display();
		}
		
		public function adminfilter()
		{
			JRequest::setVar('view', 'omsadmin');
			$this->display();
		}
		public function addorder()
		{
			// ��������� �����
			JRequest::checkToken() or jexit('Invalid Token');
		
			// �������� �������� �����
			$data = JRequest::get('post');
		
		
			$model = $this->getModel('order');
			// ���� ���������� ������ �������
			if ($model->addorder($data))
			{
				$message = JText::_('SAVE OK');
			} // ���� ���
			else
			{
				$message = JText::_('SAVE FAILED');
				$message .= ' ['.$model->getError().']'; // �������� ������ �� ������
			}
			// ��������������
			$this->setRedirect('index.php?option=com_oms', $message);
		}
		
		public function addpayment()
		{
			// ��������� �����
			JRequest::checkToken() or jexit('Invalid Token');
		
			// �������� �������� �����
			$data = JRequest::get('post');
		
		
			$model = $this->getModel('payments');
			// ���� ���������� ������ �������
			if ($model->addpayment($data))
			{
				$message = JText::_('SAVE OK');
			} // ���� ���
			else
			{
				$message = JText::_('SAVE FAILED');
				$message .= ' ['.$model->getError().']'; 
			}
			// ��������������
			$this->setRedirect('index.php?option=com_oms', $message);
		}
		
		
		public function saveorder()
		{
			// ��������� �����
			JRequest::checkToken() or jexit('Invalid Token');
		
			// �������� �������� �����
			$data = JRequest::get('post');
		
			#var_dump($data);die();
			
			$model = $this->getModel('orderadmin');
			// ���� ���������� ������ �������
			if ($model->editorder($data))
			{
				$message = JText::_('SAVE OK');
			} // ���� ���
			else
			{
				$message = JText::_('SAVE FAILED');
				$message .= ' ['.$model->getError().']'; // �������� ������ �� ������
			}
			// ��������������
			$this->setRedirect('index.php?option=com_oms&view=omsadmin', $message);
		}
		
		public function editorder()
		{
			JRequest::setVar('view', 'orderadmin');
			$this->display();
		}
		
		
		
	}
}