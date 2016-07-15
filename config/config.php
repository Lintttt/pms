<?php
/**
 * The config file of ZenTaoPMS.
 *
 * Don't modify this file directly, copy the item to my.php and change it.
 *
 * @copyright   Copyright 2009-2013 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     config
 * @version     $Id: config.php 5068 2013-07-08 02:41:22Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
/* Judge class config and function getWebRoot exists or not, make sure php shells can work. */
if(!class_exists('config')){class config{}}
if(!function_exists('getWebRoot')){function getWebRoot(){}}

/* Basic settings. */
$config = new config();
$config->version      = '6.3';             // The version of zentaopms. Don't change it.
$config->charset      = 'UTF-8';           // The charset of zentaopms.
$config->cookieLife   = time() + 2592000;  // The cookie life time.
$config->timezone     = 'Asia/Shanghai';   // The time zone setting, for more see http://www.php.net/manual/en/timezones.php
$config->webRoot      = '';                // The root path of the pms.
$config->checkVersion = true;              // Auto check for new version or not.
/* The request settings. */
$config->requestType = 'PATH_INFO';       // The request type: PATH_INFO|GET, if PATH_INFO, must use url rewrite.
$config->pathType    = 'clean';           // If the request type is PATH_INFO, the path type.
$config->requestFix  = '-';               // The divider in the url when PATH_INFO.
$config->moduleVar   = 'm';               // requestType=GET: the module var name.
$config->methodVar   = 'f';               // requestType=GET: the method var name.
$config->viewVar     = 't';               // requestType=GET: the view var name.
$config->sessionVar  = 'sid';             // requestType=GET: the session var name.

/* Supported views. */
$config->views  = ',html,json,mhtml,'; 

/* Set the wide window size and timeout(ms) and duplicate interval time(s). */
$config->wideSize      = 1400;
$config->timeout       = 30000;
$config->duplicateTime = 60;

/* Supported languages. */
$config->langs['zh-cn'] = '简体';
//$config->langs['zh-tw'] = '繁體';
//$config->langs['en']    = 'English';

/* Supported charsets. */
$config->charsets['zh-cn']['utf-8'] = 'UTF-8';
$config->charsets['zh-cn']['gbk']   = 'GBK';
$config->charsets['zh-tw']['utf-8'] = 'UTF-8';
$config->charsets['zh-tw']['big5']  = 'BIG5';
$config->charsets['en']['utf-8']    = 'UTF-8';

/* Default settings. */
$config->default = new stdclass();
$config->default->view   = 'html';        // Default view.
$config->default->lang   = 'en';          // Default language.
$config->default->theme  = 'default';     // Default theme.
$config->default->module = 'index';       // Default module.
$config->default->method = 'index';       // Default method.

/* Upload settings. */
$config->file = new stdclass();
$config->file->dangers = 'php,php3,php4,phtml,php5,jsp,py,rb,asp,asa,cer,cdx,aspl'; // Dangerous files.
$config->file->maxSize = 1024 * 1024;          // Max size.

/* View type settings. */ 
$config->viewPrefix['mhtml'] = 'm.';

/* Master database settings. */
$config->db = new stdclass();
$config->db->persistant     = false;     // Pconnect or not.
$config->db->driver         = 'mysql';   // Must be MySQL. Don't support other database server yet.
$config->db->encoding       = 'UTF8';    // Encoding of database.
$config->db->strictMode     = false;     // Turn off the strict mode of MySQL.
//$config->db->emulatePrepare = true;    // PDO::ATTR_EMULATE_PREPARES
//$config->db->bufferQuery    = true;     // PDO::MYSQL_ATTR_USE_BUFFERED_QUERY

/* Slave database settings. */
$config->slaveDB = new stdclass();
$config->slaveDB->persistant = false;      
$config->slaveDB->driver     = 'mysql';    
$config->slaveDB->encoding   = 'UTF8';     
$config->slaveDB->strictMode = false;      
$config->slaveDB->checkCentOS= true;       

/* Include the custom config file. */
$configRoot = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$myConfig   = $configRoot . 'my.php';
if(file_exists($myConfig)) include $myConfig;

/* Set default table prefix. */
if(!isset($config->db->prefix)) $config->db->prefix = 'zt_';

/* Define the tables. */
define('TABLE_REPORT',        '`' . $config->db->prefix . 'report`');
define('TABLE_INTENTION',     '`' . $config->db->prefix . 'intention`');
define('TABLE_CUSTOMER',      '`' . $config->db->prefix . 'customer`');
define('TABLE_ARTICLE',       '`' . $config->db->prefix . 'article`');
define('TABLE_AUTHOR',        '`' . $config->db->prefix . 'author`');
define('TABLE_AMOUNT',        '`' . $config->db->prefix . 'amount`');
define('TABLE_SALER',         '`' . $config->db->prefix . 'saler`');
define('TABLE_NOTICE',        '`' . $config->db->prefix . 'notice`');
define('TABLE_STAFFENTRY',    '`' . $config->db->prefix . 'staffentry`');
define('TABLE_RECRUIT',       '`' . $config->db->prefix . 'recruit`');
define('TABLE_RECRUIT_INTERVIEW', '`' . $config->db->prefix . 'recruit_interview`');
define('TABLE_RECRUIT_SOURCE','`' . $config->db->prefix . 'recruit_source`');
define('TABLE_STAFFLEAVE',    '`' . $config->db->prefix . 'staffleave`');
define('TABLE_VACATION',      '`' . $config->db->prefix . 'vacation`');
define('TABLE_MATERIAL',      '`' . $config->db->prefix . 'material`');
define('TABLE_APPLICATION',     '`' . $config->db->prefix . 'application`');
define('TABLE_PROJECTMEMBERS',  '`' . $config->db->prefix . 'projectmembers`');
define('TABLE_APPLICATIONFILES','`' . $config->db->prefix . 'applicationfiles`');
define('TABLE_EXPENSE',         '`' . $config->db->prefix . 'expense`');
define('TABLE_EXPENSEAPPLICATION','`' . $config->db->prefix . 'expenseapplication`');
define('TABLE_TRIP',            '`' . $config->db->prefix . 'trip`');
define('TABLE_VIEWCOLLECTION','`' . $config->db->prefix . 'viewcollection`');
define('TABLE_COMPANY',       '`' . $config->db->prefix . 'company`');
define('TABLE_DEPT',          '`' . $config->db->prefix . 'dept`');
define('TABLE_CONFIG',        '`' . $config->db->prefix . 'config`');
define('TABLE_USER',          '`' . $config->db->prefix . 'user`');
define('TABLE_TODO',          '`' . $config->db->prefix . 'todo`');
define('TABLE_GROUP',         '`' . $config->db->prefix . 'group`');
define('TABLE_GROUPPRIV',     '`' . $config->db->prefix . 'grouppriv`');
define('TABLE_USERGROUP',     '`' . $config->db->prefix . 'usergroup`');
define('TABLE_USERQUERY',     '`' . $config->db->prefix . 'userquery`');
define('TABLE_USERCONTACT',   '`' . $config->db->prefix . 'usercontact`');
define('TABLE_FRIDGE',          '`' . $config->db->prefix . 'fridge`');
define('TABLE_FRIDGEFLOOR',     '`' . $config->db->prefix . 'fridgefloor`');
define('TABLE_FRIDGEDETAIL',    '`' . $config->db->prefix . 'fridgedetail`');
define('TABLE_FRIDGESAMPLE',    '`' . $config->db->prefix . 'fridgesample`');
define('TABLE_FRIDGESTATE',     '`' . $config->db->prefix . 'fridgestate`');
define('TABLE_FRIDGEACTION',    '`' . $config->db->prefix . 'fridgeaction`');
define('TABLE_MEETINGROOM',     '`' . $config->db->prefix . 'meetingroom`');
define('TABLE_MEETINGMODEL',    '`' . $config->db->prefix . 'meetingmodel`');
define('TABLE_MEETINGINIT',     '`' . $config->db->prefix . 'meetinginit`');

define('TABLE_BUG',           '`' . $config->db->prefix . 'bug`');
define('TABLE_CASE',          '`' . $config->db->prefix . 'case`');
define('TABLE_CASESTEP',      '`' . $config->db->prefix . 'casestep`');
define('TABLE_TESTTASK',      '`' . $config->db->prefix . 'testtask`');
define('TABLE_TESTRUN',       '`' . $config->db->prefix . 'testrun`');
define('TABLE_TESTRESULT',    '`' . $config->db->prefix . 'testresult`');
define('TABLE_USERTPL',       '`' . $config->db->prefix . 'usertpl`');

define('TABLE_PRODUCT',       '`' . $config->db->prefix . 'product`');
define('TABLE_STORY',         '`' . $config->db->prefix . 'story`');
define('TABLE_STORYSPEC',     '`' . $config->db->prefix . 'storyspec`');
define('TABLE_PRODUCTPLAN',   '`' . $config->db->prefix . 'productplan`');
define('TABLE_RELEASE',       '`' . $config->db->prefix . 'release`');

 define('TABLE_FEEDBACK',       '`' . $config->db->prefix . 'feedback`');
define('TABLE_PROJECT',       '`' . $config->db->prefix . 'project`');
define('TABLE_TASK',          '`' . $config->db->prefix . 'task`');
define('TABLE_TEAM',          '`' . $config->db->prefix . 'team`');
define('TABLE_PROJECTPRODUCT','`' . $config->db->prefix . 'projectproduct`');
define('TABLE_PROJECTSTORY',  '`' . $config->db->prefix . 'projectstory`');
define('TABLE_TASKESTIMATE',  '`' . $config->db->prefix . 'taskestimate`');
define('TABLE_EFFORT',        '`' . $config->db->prefix . 'effort`');
define('TABLE_BURN',          '`' . $config->db->prefix . 'burn`');
define('TABLE_BUILD',         '`' . $config->db->prefix . 'build`');

define('TABLE_DOCLIB',        '`' . $config->db->prefix . 'doclib`');
define('TABLE_DOC',           '`' . $config->db->prefix . 'doc`');

define('TABLE_MODULE',        '`' . $config->db->prefix . 'module`');
define('TABLE_ACTION',        '`' . $config->db->prefix . 'action`');
define('TABLE_FILE',          '`' . $config->db->prefix . 'file`');
define('TABLE_HISTORY',       '`' . $config->db->prefix . 'history`');
define('TABLE_EXTENSION',     '`' . $config->db->prefix . 'extension`');
define('TABLE_LANG',          '`' . $config->db->prefix . 'lang`');
define('TABLE_CONTRACT',        '`' . $config->db->prefix . 'contract`');
define('TABLE_CONTRACTAMOUNT','`' . $config->db->prefix . 'contractamount`');
define('TABLE_GEPROJECT',        '`' . $config->db->prefix . 'geproject`');
define('TABLE_SAMPLE',        '`' . $config->db->prefix . 'sample`');
define('TABLE_FEEDBACK',        '`' . $config->db->prefix . 'feedback`');
define('TABLE_PROGRAM',        '`' . $config->db->prefix . 'program`');
define('TABLE_LAB',        '`' . $config->db->prefix . 'lab`');
define('TABLE_GEFILE',        '`' . $config->db->prefix . 'gefile`');
define('TABLE_UPACTION',        '`' . $config->db->prefix . 'upaction`');
define('TABLE_DEPTSHARE',        '`' . $config->db->prefix . 'deptshare`');
define('TABLE_COMSHARE',        '`' . $config->db->prefix . 'comshare`');
define('TABLE_GENESHARE',        '`' . $config->db->prefix . 'geneshare`');
define('TABLE_PAPER',        '`' . $config->db->prefix . 'paper`');
define('TABLE_PAPERFILE',        '`' . $config->db->prefix . 'paperfile`');
define('TABLE_LITERATURE',        '`' . $config->db->prefix . 'literature`');
define('TABLE_ANALYFEEDBACK',        '`' . $config->db->prefix . 'analyfeedback`');
define('TABLE_WEEKLY',        '`' . $config->db->prefix . 'weekly`');
define('TABLE_SAMPLELIST',        '`' . $config->db->prefix . 'samplelist`');
define('TABLE_PROJECTSAMPLE',        '`' . $config->db->prefix . 'projectsample`');
define('TABLE_EXTRACT_PLAN',        '`' . $config->db->prefix . 'extract_plan`');
define('TABLE_EXTRACT_PLAN_SAMPLE',        '`' . $config->db->prefix . 'extract_plan_sample`');
define('TABLE_PROJECTEXTRACT',        '`' . $config->db->prefix . 'projectextract`');
define('TABLE_PROJECTDETECT',        '`' . $config->db->prefix . 'projectdetect`');
define('TABLE_LIB',        '`' . $config->db->prefix . 'lib`');
define('TABLE_LIB_INFO',        '`' . $config->db->prefix . 'lib_info`');
define('TABLE_LIBSAMPLE',        '`' . $config->db->prefix . 'libsample`');
define('TABLE_LAB_LIBORDER',        '`' . $config->db->prefix . 'lab_liborder`');
define('TABLE_LIB_RATION',        '`' . $config->db->prefix . 'lib_ration`');
define('TABLE_LAB_COMBINEORDER',        '`' . $config->db->prefix . 'lab_combineorder`');
define('TABLE_LIB_POOLING',        '`' . $config->db->prefix . 'lib_pooling`');
define('TABLE_LIB_LANE',        '`' . $config->db->prefix . 'lib_lane`');
define('TABLE_LIB_SEND',        '`' . $config->db->prefix . 'lib_send`');
define('TABLE_RATION_ORDER',        '`' . $config->db->prefix . 'ration_order`');
define('TABLE_PLATEFORM_PRICE',        '`' . $config->db->prefix . 'plateform_price`');
define('TABLE_BUSINESS_PRICE',        '`' . $config->db->prefix . 'business_price`');
define('TABLE_TRIAL_PURCHASE',        '`' . $config->db->prefix . 'trial_purchase`');
define('TABLE_TRIAL_INVOICE',        '`' . $config->db->prefix . 'trial_invoice`');
define('TABLE_TRIAL_ITEM',        '`' . $config->db->prefix . 'trial_item`');
define('TABLE_TISSUE_SAMPLE_FEE',        '`' . $config->db->prefix . 'tissue_sample_fee`');

define('TABLE_EXPRESS',        '`' . $config->db->prefix . 'express`');
define('TABLE_HOLIDAY',        '`' . $config->db->prefix . 'holiday`');
define('TABLE_PROJECTPROCESS', '`' . $config->db->prefix . 'projectprocess`');

$config->objectTables['report']      = TABLE_REPORT;
$config->objectTables['intention']   = TABLE_INTENTION;
$config->objectTables['customer']    = TABLE_CUSTOMER;
$config->objectTables['product']     = TABLE_PRODUCT;
$config->objectTables['story']       = TABLE_STORY;
$config->objectTables['productplan'] = TABLE_PRODUCTPLAN;
$config->objectTables['release']     = TABLE_RELEASE;
$config->objectTables['project']     = TABLE_PROJECT;
$config->objectTables['task']        = TABLE_TASK;
$config->objectTables['build']       = TABLE_BUILD;
$config->objectTables['bug']         = TABLE_BUG;
$config->objectTables['case']        = TABLE_CASE;
$config->objectTables['testcase']    = TABLE_CASE;
$config->objectTables['testtask']    = TABLE_TESTTASK;
$config->objectTables['user']        = TABLE_USER;
$config->objectTables['doc']         = TABLE_DOC;
$config->objectTables['doclib']      = TABLE_DOCLIB;
$config->objectTables['todo']        = TABLE_TODO;
$config->objectTables['custom']      = TABLE_LANG;
$config->objectTables['contract']      = TABLE_CONTRACT;
$config->objectTables['geproject']      = TABLE_GEPROJECT;
$config->objectTables['sample']      = TABLE_SAMPLE;
$config->objectTables['feedback']      = TABLE_FEEDBACK;
$config->objectTables['program']      = TABLE_PROGRAM;
$config->objectTables['feedback']      = TABLE_FEEDBACK;
$config->objectTables['lab']        =     TABLE_LAB;
$config->objectTables['geneshare']        =     TABLE_GENESHARE;
$config->objectTables['comshare']        =     TABLE_COMSHARE;
$config->objectTables['deptshare']        =     TABLE_DEPTSHARE;
$config->objectTables['upaction']        =     TABLE_UPACTION;
$config->objectTables['gefile']        =     TABLE_GEFILE;
$config->objectTables['dept']        =     TABLE_DEPT;
$config->objectTables['analyfeedback']      = TABLE_ANALYFEEDBACK;
$config->objectTables['weekly']      = TABLE_WEEKLY;
$config->objectTables['samplelist']      = TABLE_SAMPLELIST;


/* Include extension config files. */
$extConfigFiles = glob($configRoot . 'ext/*.php');
if($extConfigFiles) foreach($extConfigFiles as $extConfigFile) include $extConfigFile;
