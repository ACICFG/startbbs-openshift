<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';$active_record = TRUE;
$db['default']['hostname'] = 'OPENSHIFT_MYSQL_DB_HOST';
$db['default']['username'] = 'OPENSHIFT_MYSQL_DB_USERNAME';
$db['default']['password'] = 'OPENSHIFT_MYSQL_DB_PASSWORD';
$db['default']['database'] = 'OPENSHIFT_APP_NAME';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = 'sb_';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

chmod 777 $OPENSHIFT_REPO_DIR/php/ -R