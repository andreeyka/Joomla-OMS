<?php // ������ �� ������� �������
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_COMPONENT . DS . 'controller.php');
JTable::addIncludePath(JPATH_COMPONENT . DS . 'tables');

$url_path = JURI::root(true) . '/components/com_oms/';
$document = JFactory::getDocument();
$document->addStyleSheet($url_path . 'css/style.css');


//���������� ������� ����������
$controller = JControllerLegacy::getInstance('Oms');
$controller->registerDefaultTask('Display');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();