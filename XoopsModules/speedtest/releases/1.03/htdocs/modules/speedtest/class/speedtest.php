<?php

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for Blue Room Xcenter
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class SpeedtestSpeedtest extends XoopsObject
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
    function SpeedtestSpeedtest($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('speedtest');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('ip', XOBJ_DTYPE_TXTBOX, null, false, 11);		
		$this->initVar('ip_string', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('timestamp', XOBJ_DTYPE_TXTBOX, null, false, 19);
        $this->initVar('downspeed', XOBJ_DTYPE_TXTBOX, null, false, 15);		
        $this->initVar('upspeed', XOBJ_DTYPE_TXTBOX, null, false, 15);		
    }
        
    function toArray() {
    	$ret = parent::toArray();
    	$user_handler = xoops_gethandler('user');
    	if ($this->getVar('uid')>0) {
    		$user = $user_handler->get($this->getVar('uid'));
    		if (is_object($user))
    			$ret['user']['uid'] = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$user->getVar('uid').'">'.$user->getVar('uname').'</a>';
    		else 
    		 	$ret['user']['uid'] = _MI_USER_GUEST; 
    	} else {
    		$ret['user']['uid'] = _MI_USER_GUEST; 
    	}
    	return $ret;
    }   
}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class SpeedtestSpeedtestHandler extends XoopsPersistableObjectHandler
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
	function __construct(&$db) 
    {
		$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('speedtest');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
    	
		$this->db = $db;
        parent::__construct($db, 'speedtest', 'SpeedtestSpeedtest', "id", "ip");
    }

    function insert($object, $force = true) {
    	if (is_object($GLOBALS['xoopsUser']))
    		$object->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
    	return parent::insert($object, $force);
    }
    
    function getFilterCriteria($filter) {
    	$parts = explode('|', $filter);
    	$criteria = new CriteriaCompo();
    	foreach($parts as $part) {
    		$var = explode(',', $part);
    		if (!empty($var[1])&&!is_numeric($var[0])) {
    			$object = $this->create();
    			if (		$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTBOX || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTAREA) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%'.$var[1].'%', (isset($var[2])?$var[2]:'LIKE')));
    			} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_INT || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_DECIMAL || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_FLOAT ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));			
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ENUM ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));    				
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ARRAY ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%"'.$var[1].'";%', (isset($var[2])?$var[2]:'LIKE')));    				
				}
    		} elseif (!empty($var[1])&&is_numeric($var[0])) {
    			$criteria->add(new Criteria("'".$var[0]."'", $var[1]));
    		}
    	}
    	return $criteria;
    }
        
	function getFilterForm($filter, $field, $sort='created', $op = '', $fct = '') {
    	$ele = speedtest_getFilterElement($filter, $field, $sort, $op, $fct);
    	if (is_object($ele))
    		return $ele->render();
    	else 
    		return '&nbsp;';
    }
    
    function getMaximum($field) {
    	if (empty($field))	
    		return false;
    	$sql = "SELECT MAX(`".$field."`) as `result` FROM " . $GLOBALS['xoopsDB']->prefix('speedtest') . " WHERE `".$field."` > 0";
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	list($ret) = $GLOBALS['xoopsDB']->fetchRow($result);
    	return number_format($ret, 2);
    }
    
	function getMinimum($field) {
    	if (empty($field))	
    		return false;
    	$sql = "SELECT MIN(`".$field."`) as `result` FROM " . $GLOBALS['xoopsDB']->prefix('speedtest') . " WHERE `".$field."` > 0";
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	list($ret) = $GLOBALS['xoopsDB']->fetchRow($result);
    	return number_format($ret, 2);
    }

    function getAverage($field) {
    	if (empty($field))	
    		return false;
    	$sql = "SELECT AVG(`".$field."`) as `result` FROM " . $GLOBALS['xoopsDB']->prefix('speedtest') . " WHERE `".$field."` > 0";
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	list($ret) = $GLOBALS['xoopsDB']->fetchRow($result);
    	return number_format($ret, 2);
    }
    
}

?>