<?php
/**
 * Forum
 *
 * @author Kyle Florence, Saipetch Kongkatong, Tomasz Odrobny
 *
 */

$wgExtensionCredits['specialpage'][] = array(
	'name' => 'Forum',
	'author' => array( 'Kyle Florence', 'Saipetch Kongkatong', 'Tomasz Odrobny' )
);

$dir = dirname(__FILE__) . '/';
$app = F::app();

// classes
$app->registerClass('ForumSpecialController', $dir . 'ForumSpecialController.class.php');
$app->registerClass('ForumHooksHelper', $dir . 'ForumHooksHelper.class.php');
$app->registerClass('ForumController', $dir . 'ForumController.class.php');
$app->registerClass('ForumNotificationPlugin', $dir . 'ForumNotificationPlugin.class.php');
$app->registerClass('ForumBoardHelper', $dir . 'ForumBoardHelper.class.php');

// i18n mapping
$app->registerExtensionMessageFile('Forum', $dir . 'Forum.i18n.php');

// special pages
$app->registerSpecialPage('Forum', 'ForumSpecialController');

// hooks
$app->registerHook('AfterWallWikiActivityFilter', 'ForumHooksHelper', 'onAfterWallWikiActivityFilter');
$app->registerHook('ArticleViewHeader', 'ForumHooksHelper', 'onArticleViewHeader');
$app->registerHook('BeforeToolbarMenu', 'ForumHooksHelper', 'onBeforeToolbarMenu');
$app->registerHook('NotificationGetNotificationMessage', 'ForumNotificationPlugin', 'onGetNotificationMessage');
$app->registerHook('WallContributionsLine', 'ForumHooksHelper', 'onWallContributionsLine' ); 
$app->registerHook('getUserPermissionsErrors', 'ForumHooksHelper', 'getUserPermissionsErrors');
$app->registerHook('WallRecentchangesMessagePrefix', 'ForumHooksHelper', 'onWallRecentchangesMessagePrefix');
$app->registerHook('NotificationGetMailNotificationMessage', 'ForumNotificationPlugin', 'onGetMailNotificationMessage');
$app->registerHook('WallThreadHeader', 'ForumHooksHelper', 'onWallThreadHeader');
$app->registerHook('WallHistoryThreadHeader', 'ForumHooksHelper', 'onWallHistoryThreadHeader');
$app->registerHook('WallHeader', 'ForumHooksHelper', 'onWallHeader');
$app->registerHook('WallNewMessage', 'ForumHooksHelper', 'onWallNewMessage');
$app->registerHook('EditCommentsIndex', 'ForumHooksHelper', 'onEditCommentsIndex');
$app->registerHook('ArticleInsertComplete', 'ForumHooksHelper', 'onArticleInsertComplete');


include($dir . '/Forum.namespace.setup.php');

// permissions
$wgAvailableRights[] = 'forum';
$wgAvailableRights[] = 'boardedit';

$wgGroupPermissions['*']['forum'] = false;
$wgGroupPermissions['staff']['forum'] = true;
$wgGroupPermissions['sysop']['forum'] = true;
$wgGroupPermissions['bureaucrat']['forum'] = true;

$wgRevokePermissions['vstf']['forum'] = true;

$wgGroupPermissions['*']['boardedit'] = false;
$wgGroupPermissions['staff']['boardedit'] = true;
