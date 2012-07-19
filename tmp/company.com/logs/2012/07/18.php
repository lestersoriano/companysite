<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-07-18 02:16:10 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:16:10 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:17:33 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:17:33 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:17:34 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:17:34 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:17:35 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:17:35 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:17:54 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:17:54 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:18:05 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:18:05 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:18:06 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:18:06 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:18:12 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:18:12 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:18:40 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
2012-07-18 02:18:40 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_display_name() ~ APPPATH/classes/controller/demo.php [ 13 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:20:33 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:20:33 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:21:55 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:21:55 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(22): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:22:47 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:22:47 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(22): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:22:49 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:22:49 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(22): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:23:06 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:23:06 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:23:06 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:23:06 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:23:23 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_displayname() ~ MODPATH/orm/classes/orm.php [ 19 ]
2012-07-18 02:23:23 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_displayname() ~ MODPATH/orm/classes/orm.php [ 19 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:23:24 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_displayname() ~ MODPATH/orm/classes/orm.php [ 19 ]
2012-07-18 02:23:24 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_displayname() ~ MODPATH/orm/classes/orm.php [ 19 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:25:03 --- ERROR: ErrorException [ 1 ]: Class 'Model_Company_Model_User' not found ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
2012-07-18 02:25:03 --- STRACE: ErrorException [ 1 ]: Class 'Model_Company_Model_User' not found ~ MODPATH/orm/classes/kohana/orm.php [ 37 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:25:14 --- ERROR: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:25:14 --- STRACE: Kohana_Exception [ 0 ]: The displayname property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('displayname')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('displayname')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:28:20 --- ERROR: Kohana_Exception [ 0 ]: The hello property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:28:20 --- STRACE: Kohana_Exception [ 0 ]: The hello property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('hello')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('hello')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:28:51 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:28:51 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:29:18 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:29:18 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:29:20 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:29:20 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:36:15 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:36:15 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:36:18 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:36:18 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:36:21 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:36:21 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::get_hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:36:46 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_User::hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
2012-07-18 02:36:46 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_User::hello() ~ APPPATH/classes/controller/demo.php [ 11 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:36:52 --- ERROR: Kohana_Exception [ 0 ]: The hello property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
2012-07-18 02:36:52 --- STRACE: Kohana_Exception [ 0 ]: The hello property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 612 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(21): Kohana_ORM->__get('hello')
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(11): ORM->__get('hello')
#2 [internal function]: Controller_Demo->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 02:45:55 --- ERROR: ErrorException [ 2 ]: array_walk() expects parameter 2 to be a valid callback, class 'Security' does not have a method 'xss_clean' ~ APPPATH/classes/controller/demo.php [ 52 ]
2012-07-18 02:45:55 --- STRACE: ErrorException [ 2 ]: array_walk() expects parameter 2 to be a valid callback, class 'Security' does not have a method 'xss_clean' ~ APPPATH/classes/controller/demo.php [ 52 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'array_walk() ex...', '/Applications/M...', 52, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(52): array_walk(Array, Array)
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#3 [internal function]: Controller_Demo->action_login()
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#8 {main}
2012-07-18 02:46:07 --- ERROR: Kohana_Exception [ 0 ]: A valid hash key must be set in your auth config. ~ MODPATH/auth/classes/kohana/auth.php [ 153 ]
2012-07-18 02:46:07 --- STRACE: Kohana_Exception [ 0 ]: A valid hash key must be set in your auth config. ~ MODPATH/auth/classes/kohana/auth.php [ 153 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth/file.php(40): Kohana_Auth->hash('lss11283')
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(90): Kohana_Auth_File->_login('krsnic03', 'lss11283', true)
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(54): Kohana_Auth->login('krsnic03', 'lss11283', true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#4 [internal function]: Controller_Demo->action_login()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#9 {main}
2012-07-18 02:49:15 --- ERROR: ErrorException [ 1 ]: Call to undefined method Auth_File::auto_login() ~ MODPATH/auth/classes/auth.php [ 12 ]
2012-07-18 02:49:15 --- STRACE: ErrorException [ 1 ]: Call to undefined method Auth_File::auto_login() ~ MODPATH/auth/classes/auth.php [ 12 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 02:55:56 --- ERROR: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
2012-07-18 02:55:56 --- STRACE: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1200): Kohana_ORM->check(NULL)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1314): Kohana_ORM->create(NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(151): Kohana_ORM->save(NULL)
#3 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(41): ORM->save()
#4 [internal function]: Controller_Demo->action_login()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#9 {main}
2012-07-18 03:10:14 --- ERROR: ErrorException [ 8 ]: Undefined index: lestersoriano ~ MODPATH/auth/classes/kohana/auth/file.php [ 44 ]
2012-07-18 03:10:14 --- STRACE: ErrorException [ 8 ]: Undefined index: lestersoriano ~ MODPATH/auth/classes/kohana/auth/file.php [ 44 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth/file.php(44): Kohana_Core::error_handler(8, 'Undefined index...', '/Applications/M...', 44, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(94): Kohana_Auth_File->_login('lestersoriano', 'lss11283', true)
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(72): Kohana_Auth->login('lestersoriano', 'lss11283', true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#4 [internal function]: Controller_Demo->action_login()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#9 {main}
2012-07-18 03:24:31 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry '1' for key 'entity_id' [ INSERT INTO `users` (`username`, `email`, `password`, `department_id`, `client_id`, `display_name`, `full_name`, `first_name`, `last_name`, `image_url`, `slug`, `is_active`, `date_last_login`, `entity_id`) VALUES ('lestersoriano', 'lestersoriano@yahoo.com', 'fb7d89d5b65ebbe51a4637876e28b7b9c0ad4ad83108c0507f327b9e7fb36398', 1, 1, 'frozentech', 'lester soriano', 'lester', 'soriano', '', 'frozentech', 1, now(), 1) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-07-18 03:24:31 --- STRACE: Database_Exception [ 1062 ]: Duplicate entry '1' for key 'entity_id' [ INSERT INTO `users` (`username`, `email`, `password`, `department_id`, `client_id`, `display_name`, `full_name`, `first_name`, `last_name`, `image_url`, `slug`, `is_active`, `date_last_login`, `entity_id`) VALUES ('lestersoriano', 'lestersoriano@yahoo.com', 'fb7d89d5b65ebbe51a4637876e28b7b9c0ad4ad83108c0507f327b9e7fb36398', 1, 1, 'frozentech', 'lester soriano', 'lester', 'soriano', '', 'frozentech', 1, now(), 1) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(2, 'INSERT INTO `us...', false, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1222): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1314): Kohana_ORM->create(NULL)
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/orm.php(151): Kohana_ORM->save(NULL)
#4 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(46): ORM->save()
#5 [internal function]: Controller_Demo->action_create()
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#10 {main}
2012-07-18 03:27:03 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ECHO ~ MODPATH/orm/classes/kohana/auth/orm.php [ 92 ]
2012-07-18 03:27:03 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_ECHO ~ MODPATH/orm/classes/kohana/auth/orm.php [ 92 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 03:32:41 --- ERROR: ErrorException [ 1 ]: Class 'Controller_Template_Layout' not found ~ APPPATH/classes/controller/layout.php [ 4 ]
2012-07-18 03:32:41 --- STRACE: ErrorException [ 1 ]: Class 'Controller_Template_Layout' not found ~ APPPATH/classes/controller/layout.php [ 4 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 03:43:49 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:43:49 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(13): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:45:33 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:45:33 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:47:14 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
2012-07-18 03:47:14 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(132): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 132, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:47:16 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
2012-07-18 03:47:16 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(132): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 132, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:47:24 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
2012-07-18 03:47:24 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 132 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(132): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 132, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:48:02 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:48:02 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:49:15 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:49:15 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(11): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:52:33 --- ERROR: Kohana_Exception [ 0 ]: Cannot overwrite value for footer. ~ MODPATH/layout/classes/layout/core.php [ 107 ]
2012-07-18 03:52:33 --- STRACE: Kohana_Exception [ 0 ]: Cannot overwrite value for footer. ~ MODPATH/layout/classes/layout/core.php [ 107 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(10): Layout_Core->__set('footer', 'footer')
#1 [internal function]: Controller_Layout->action_index()
#2 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#6 {main}
2012-07-18 03:52:46 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:52:46 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(10): Layout_Core->__get('footer')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:53:03 --- ERROR: View_Exception [ 0 ]: The requested view FOOTER HERE could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 03:53:03 --- STRACE: View_Exception [ 0 ]: The requested view FOOTER HERE could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('FOOTER HERE')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('FOOTER HERE', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('FOOTER HERE')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(185): Layout_Core::set_path(NULL, 'FOOTER HERE')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(74): Layout_Core->set_footer('FOOTER HERE')
#5 [internal function]: Layout_Controller->before()
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Layout))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#10 {main}
2012-07-18 03:53:48 --- ERROR: View_Exception [ 0 ]: The requested view footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 03:53:48 --- STRACE: View_Exception [ 0 ]: The requested view footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('footer')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('footer', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('footer')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(185): Layout_Core::set_path(NULL, 'footer')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(74): Layout_Core->set_footer('footer')
#5 [internal function]: Layout_Controller->before()
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Layout))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#10 {main}
2012-07-18 03:54:32 --- ERROR: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
2012-07-18 03:54:32 --- STRACE: ErrorException [ 8 ]: Only variable references should be returned by reference ~ MODPATH/layout/classes/layout/core.php [ 130 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(130): Kohana_Core::error_handler(8, 'Only variable r...', '/Applications/M...', 130, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(14): Layout_Core->__get('header')
#2 [internal function]: Controller_Layout->action_index()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Layout))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 03:55:54 --- ERROR: View_Exception [ 0 ]: The requested view footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 03:55:54 --- STRACE: View_Exception [ 0 ]: The requested view footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('footer')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('footer', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('footer')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(185): Layout_Core::set_path(NULL, 'footer')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(74): Layout_Core->set_footer('footer')
#5 [internal function]: Layout_Controller->before()
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Layout))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#10 {main}
2012-07-18 04:02:45 --- ERROR: Kohana_Exception [ 0 ]: A valid hash key must be set in your auth config. ~ MODPATH/auth/classes/kohana/auth.php [ 153 ]
2012-07-18 04:02:45 --- STRACE: Kohana_Exception [ 0 ]: A valid hash key must be set in your auth config. ~ MODPATH/auth/classes/kohana/auth.php [ 153 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth/file.php(40): Kohana_Auth->hash('lss11283')
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(90): Kohana_Auth_File->_login('lestersoriano', 'lss11283', true)
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(72): Kohana_Auth->login('lestersoriano', 'lss11283', true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#4 [internal function]: Controller_Demo->action_login()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#9 {main}
2012-07-18 04:12:54 --- ERROR: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/kohana/cookie.php [ 152 ]
2012-07-18 04:12:54 --- STRACE: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/kohana/cookie.php [ 152 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/cookie.php(115): Kohana_Cookie::salt('authautologin', 'a27b5b1dc37911e...')
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/auth/orm.php(103): Kohana_Cookie::set('authautologin', 'a27b5b1dc37911e...', 1209600)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(90): Kohana_Auth_ORM->_login('lestersoriano', 'lss11283', true)
#3 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(72): Kohana_Auth->login('lestersoriano', 'lss11283', true)
#4 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#5 [internal function]: Controller_Demo->action_login()
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#10 {main}
2012-07-18 04:14:49 --- ERROR: Kohana_Exception [ 0 ]: The logins property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 681 ]
2012-07-18 04:14:49 --- STRACE: Kohana_Exception [ 0 ]: The logins property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 681 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(634): Kohana_ORM->set('logins', Object(Database_Expression))
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(88): Kohana_ORM->__set('logins', Object(Database_Expression))
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/auth/orm.php(262): Model_Auth_User->complete_login()
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/auth/orm.php(107): Kohana_Auth_ORM->complete_login(Object(Model_User))
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(90): Kohana_Auth_ORM->_login('lestersoriano', 'lss11283', true)
#5 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(72): Kohana_Auth->login('lestersoriano', 'lss11283', true)
#6 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#7 [internal function]: Controller_Demo->action_login()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}
2012-07-18 04:15:06 --- ERROR: Kohana_Exception [ 0 ]: The last_login property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 681 ]
2012-07-18 04:15:06 --- STRACE: Kohana_Exception [ 0 ]: The last_login property does not exist in the Model_User class ~ MODPATH/orm/classes/kohana/orm.php [ 681 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(634): Kohana_ORM->set('last_login', 1342602906)
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(91): Kohana_ORM->__set('last_login', 1342602906)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/auth/orm.php(262): Model_Auth_User->complete_login()
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/auth/orm.php(107): Kohana_Auth_ORM->complete_login(Object(Model_User))
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/auth/classes/kohana/auth.php(90): Kohana_Auth_ORM->_login('lestersoriano', 'lss11283', true)
#5 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(72): Kohana_Auth->login('lestersoriano', 'lss11283', true)
#6 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#7 [internal function]: Controller_Demo->action_login()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}
2012-07-18 04:15:12 --- ERROR: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/classes/controller/demo.php [ 76 ]
2012-07-18 04:15:12 --- STRACE: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/classes/controller/demo.php [ 76 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(76): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 76, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(25): Controller_Demo->login()
#2 [internal function]: Controller_Demo->action_login()
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#7 {main}
2012-07-18 04:16:16 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/controller/demo.php [ 15 ]
2012-07-18 04:16:16 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/controller/demo.php [ 15 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-07-18 04:19:02 --- ERROR: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
2012-07-18 04:19:02 --- STRACE: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1200): Kohana_ORM->check(Object(Validation))
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(167): Kohana_ORM->create(Object(Validation))
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(22): Model_Auth_User->create_user(Array, Array)
#3 [internal function]: Controller_Demo->action_create()
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#8 {main}
2012-07-18 04:21:02 --- ERROR: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
2012-07-18 04:21:02 --- STRACE: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1200): Kohana_ORM->check(Object(Validation))
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(167): Kohana_ORM->create(Object(Validation))
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(24): Model_Auth_User->create_user(Array, Array)
#3 [internal function]: Controller_Demo->action_create()
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#8 {main}
2012-07-18 04:21:52 --- ERROR: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
2012-07-18 04:21:52 --- STRACE: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1200): Kohana_ORM->check(Object(Validation))
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(167): Kohana_ORM->create(Object(Validation))
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(24): Model_Auth_User->create_user(Array, Array)
#3 [internal function]: Controller_Demo->action_create()
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#8 {main}
2012-07-18 04:22:09 --- ERROR: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
2012-07-18 04:22:09 --- STRACE: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/kohana/orm.php [ 1174 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/kohana/orm.php(1200): Kohana_ORM->check(Object(Validation))
#1 /Applications/MAMP/htdocs/matchmove/companysite/modules/orm/classes/model/auth/user.php(167): Kohana_ORM->create(Object(Validation))
#2 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/demo.php(24): Model_Auth_User->create_user(Array, Array)
#3 [internal function]: Controller_Demo->action_create()
#4 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Demo))
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#8 {main}
2012-07-18 04:48:25 --- ERROR: View_Exception [ 0 ]: The requested view content/demo/login could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 04:48:25 --- STRACE: View_Exception [ 0 ]: The requested view content/demo/login could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('content/demo/lo...')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('content/demo/lo...', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('content/demo/lo...')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(143): Layout_Core::set_path(NULL, 'content/demo/lo...')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(55): Layout_Core->set_body('content/demo/lo...')
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(35): Layout_Core->__construct('template/defaul...', 'content/demo/lo...', NULL, NULL)
#6 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(64): Layout_Core::factory('template/defaul...', 'content/demo/lo...')
#7 [internal function]: Layout_Controller->before()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}
2012-07-18 04:48:42 --- ERROR: View_Exception [ 0 ]: The requested view content/demo/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 04:48:42 --- STRACE: View_Exception [ 0 ]: The requested view content/demo/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('content/demo/in...')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('content/demo/in...', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('content/demo/in...')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(143): Layout_Core::set_path(NULL, 'content/demo/in...')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(55): Layout_Core->set_body('content/demo/in...')
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(35): Layout_Core->__construct('template/defaul...', 'content/demo/in...', NULL, NULL)
#6 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(64): Layout_Core::factory('template/defaul...', 'content/demo/in...')
#7 [internal function]: Layout_Controller->before()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}
2012-07-18 04:48:46 --- ERROR: View_Exception [ 0 ]: The requested view content/demo/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 04:48:46 --- STRACE: View_Exception [ 0 ]: The requested view content/demo/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('content/demo/in...')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('content/demo/in...', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('content/demo/in...')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(143): Layout_Core::set_path(NULL, 'content/demo/in...')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(55): Layout_Core->set_body('content/demo/in...')
#5 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(35): Layout_Core->__construct('template/defaul...', 'content/demo/in...', NULL, NULL)
#6 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(64): Layout_Core::factory('template/defaul...', 'content/demo/in...')
#7 [internal function]: Layout_Controller->before()
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Demo))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#11 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#12 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift1.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift2.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift2.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift1.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-50.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-50.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift3.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/gift3.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide1.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide1.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide2.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide2.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide3.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/slide3.jpg ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile2-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile2-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:00:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:00:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:02:59 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:02:59 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:00 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:00 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/bootstrap-responsive.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/design.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:24 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:24 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/scaffolding.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:03:25 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:03:25 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:18 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:18 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/flexslider.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/images/profile1-40.gif ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.pageslide.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-transition.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-alert.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-dropdown.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/bootstrap-button.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/waypoints.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:19 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:19 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/jquery.flexslider.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:20 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:20 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/js/application.js ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:06:20 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2012-07-18 05:06:20 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/ico/favicon.ico ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#1 {main}
2012-07-18 05:28:58 --- ERROR: View_Exception [ 0 ]: The requested view template/footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2012-07-18 05:28:58 --- STRACE: View_Exception [ 0 ]: The requested view template/footer could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(137): Kohana_View->set_filename('template/footer')
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(30): Kohana_View->__construct('template/footer', NULL)
#2 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(88): Kohana_View::factory('template/footer')
#3 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(185): Layout_Core::set_path(NULL, 'template/footer')
#4 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(74): Layout_Core->set_footer('template/footer')
#5 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/classes/controller/layout.php(40): Layout_Controller->before()
#6 [internal function]: Controller_Layout->before()
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Layout))
#8 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#11 {main}
2012-07-18 05:29:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL layout was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 113 ]
2012-07-18 05:29:25 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL layout was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 113 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#3 {main}
2012-07-18 05:47:11 --- ERROR: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
2012-07-18 05:47:11 --- STRACE: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/dropdown.php(8): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 8, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/header.php(30): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#8 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/default.php(53): Kohana_View->__toString()
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#11 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(215): Kohana_View->render()
#12 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/response.php(160): Layout_Core->__toString()
#13 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(85): Kohana_Response->body(Object(Layout))
#14 [internal function]: Layout_Controller->after()
#15 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Demo))
#16 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#17 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#18 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#19 {main}
2012-07-18 05:48:27 --- ERROR: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
2012-07-18 05:48:27 --- STRACE: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/dropdown.php(8): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 8, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/header.php(30): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#8 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/default.php(53): Kohana_View->__toString()
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#11 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(215): Kohana_View->render()
#12 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/response.php(160): Layout_Core->__toString()
#13 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(85): Kohana_Response->body(Object(Layout))
#14 [internal function]: Layout_Controller->after()
#15 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Demo))
#16 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#17 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#18 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#19 {main}
2012-07-18 05:49:47 --- ERROR: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
2012-07-18 05:49:47 --- STRACE: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH/views/template/dropdown.php [ 8 ]
--
#0 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/dropdown.php(8): Kohana_Core::error_handler(8, 'Undefined varia...', '/Applications/M...', 8, Array)
#1 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#2 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#3 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/header.php(30): Kohana_View->__toString()
#5 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#6 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#7 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(228): Kohana_View->render()
#8 /Applications/MAMP/htdocs/matchmove/companysite/apps/company.com/views/template/default.php(53): Kohana_View->__toString()
#9 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(61): include('/Applications/M...')
#10 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/view.php(343): Kohana_View::capture('/Applications/M...', Array)
#11 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/core.php(215): Kohana_View->render()
#12 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/response.php(160): Layout_Core->__toString()
#13 /Applications/MAMP/htdocs/matchmove/companysite/modules/layout/classes/layout/controller.php(85): Kohana_Response->body(Object(Layout))
#14 [internal function]: Layout_Controller->after()
#15 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Demo))
#16 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#17 /Applications/MAMP/htdocs/matchmove/companysite/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#18 /Applications/MAMP/htdocs/matchmove/companysite/webroot/index.php(135): Kohana_Request->execute()
#19 {main}