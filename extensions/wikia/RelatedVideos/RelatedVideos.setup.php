<?php
/**
 * @var WikiaApp
 */
$app = F::app();
$dir = dirname( __FILE__ );
if ( empty( $wgWikiaVideoRepoCategoryPath ) ){
	$wgWikiaVideoRepoCategoryPath = '';
}

/**
 * classes
 */
if ( empty( $wgRelatedVideosPartialRelease ) ){
	$app->registerClass('RelatedVideos', $dir . '/RelatedVideos.class.php');
	$app->registerClass('RelatedVideosHookHandler', $dir . '/RelatedVideos.hooks.php');
	$app->registerClass('RelatedVideosElement', $dir . '/models/RelatedVideos.model.php');
	$app->registerClass('RelatedVideosData', $dir . '/RelatedVideosData.class.php');
	$app->registerClass('RelatedVideosService', $dir. '/RelatedVideosService.class.php');
}
$app->registerClass('RelatedVideosNamespaceData', $dir . '/RelatedVideosNamespaceData.class.php');

/**
 * controllers
 */
if ( empty( $wgRelatedVideosPartialRelease ) ){
	$app->registerClass('RelatedVideosController', $dir . '/RelatedVideosController.class.php');
}

/**
 * hooks
 */
if ( empty( $wgRelatedVideosPartialRelease ) ){
	//$wgHooks['OutputPageBeforeHTML'][] = 'RelatedVideosHookHandler::onOutputPageBeforeHTML';
	array_splice( $wgHooks['OutputPageBeforeHTML'], 0, 0, 'RelatedVideosHookHandler::onOutputPageBeforeHTML' );
	// $app->registerHook('OutputPageMakeCategoryLinks', 'RelatedVideosController', 'onOutputPageMakeCategoryLinks');
	$app->registerHook('OutputPageMakeCategoryLinks', 'RelatedVideosHookHandler', 'onOutputPageMakeCategoryLinks');
	$app->registerHook('ArticleSaveComplete', 'RelatedVideosHookHandler', 'onArticleSaveComplete');
	$app->registerHook('BeforePageDisplay', 'RelatedVideosHookHandler', 'onBeforePageDisplay' );
}

/**
 * messages
 */
$app->registerExtensionMessageFile( 'RelatedVideos', $dir . '/RelatedVideos.i18n.php' );
if ( empty( $wgRelatedVideosPartialRelease ) ){
	F::addClassConstructor( 'RelatedVideosController', array( 'app' => $app ) );
}

/**
 * extension related configuration
 */
// setup "RelatedVideo" namespace
define('NS_RELATED_VIDEOS', 1100);

$wgExtensionNamespacesFiles['RelatedVideos'] = "{$dir}/RelatedVideos.namespaces.php";
wfLoadExtensionNamespaces('RelatedVideos', array(NS_RELATED_VIDEOS));

// permissions
$wgGroupPermissions['*']['relatedvideos'] = false;
// Ideally we would hide viewing of the namespace articles from all but admins
// and staff, but give logged-in users edit privileges (which are needed to
// support the GUI add/remove video tools).
// The relatedvideos namespace covers editing of the namespace. we should
// restrict viewing of the namespace articles in some other way.
$wgGroupPermissions['user']['relatedvideos'] = true;
//$wgGroupPermissions['staff']['relatedvideos'] = true;
$wgNamespaceProtection[ NS_RELATED_VIDEOS ] = array( 'relatedvideos' );
$wgNonincludableNamespaces[] = NS_RELATED_VIDEOS;
