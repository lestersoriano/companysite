<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-07-17 23:31:36 --- ERROR: Database_Exception [ 1044 ]: Access denied for user ''@'localhost' to database 'kohana' ~ MODPATH/database/classes/kohana/database/mysql.php [ 108 ]
2012-07-17 23:31:36 --- STRACE: Database_Exception [ 1044 ]: Access denied for user ''@'localhost' to database 'kohana' ~ MODPATH/database/classes/kohana/database/mysql.php [ 108 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/mysql.php(75): Kohana_Database_MySQL->_select_db('kohana')
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/mysql.php(171): Kohana_Database_MySQL->connect()
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1504): Kohana_Database_MySQL->list_columns('users')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns(true)
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#6 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(63): Kohana_ORM->_initialize()
#7 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(37): ORM->__construct(NULL)
#8 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(7): Kohana_ORM::factory('user')
#9 [internal function]: Controller_Demo->action_index()
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#11 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#14 {main}
2012-07-17 23:37:29 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 8 ]
2012-07-17 23:37:29 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 8 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-17 23:39:42 --- ERROR: ErrorException [ 1 ]: Class 'Model_Message' not found ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
2012-07-17 23:39:42 --- STRACE: ErrorException [ 1 ]: Class 'Model_Message' not found ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-17 23:40:12 --- ERROR: ErrorException [ 1 ]: Undefined class constant 'self::MEDIA_TYPE_GAME' ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
2012-07-17 23:40:12 --- STRACE: ErrorException [ 1 ]: Undefined class constant 'self::MEDIA_TYPE_GAME' ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-17 23:40:40 --- ERROR: Database_Exception [ 1146 ]: Table 'company.company_messages' doesn't exist [ SHOW FULL COLUMNS FROM `company_messages` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-07-17 23:40:40 --- STRACE: Database_Exception [ 1146 ]: Table 'company.company_messages' doesn't exist [ SHOW FULL COLUMNS FROM `company_messages` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1504): Kohana_Database_MySQL->list_columns('company_message...')
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns(true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(57): Kohana_ORM->_initialize()
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/company/classes/model/company/message.php(81): ORM->__construct(NULL)
#6 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(37): Model_Company_Message->__construct(NULL)
#7 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(9): Kohana_ORM::factory('company_message')
#8 [internal function]: Controller_Demo->action_index()
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#12 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#13 {main}
2012-07-17 23:41:37 --- ERROR: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/company/classes/model/company/message.php [ 87 ]
2012-07-17 23:41:37 --- STRACE: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/company/classes/model/company/message.php [ 87 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-17 23:49:01 --- ERROR: Database_Exception [ 1146 ]: Table 'company.auth_users' doesn't exist [ SHOW FULL COLUMNS FROM `auth_users` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-07-17 23:49:01 --- STRACE: Database_Exception [ 1146 ]: Table 'company.auth_users' doesn't exist [ SHOW FULL COLUMNS FROM `auth_users` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1504): Kohana_Database_MySQL->list_columns('auth_users')
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns(true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(57): Kohana_ORM->_initialize()
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(37): ORM->__construct(NULL)
#6 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(9): Kohana_ORM::factory('Auth_User')
#7 [internal function]: Controller_Demo->action_index()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}