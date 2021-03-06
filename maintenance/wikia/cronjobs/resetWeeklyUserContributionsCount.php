<?php

use \Wikia\Logger\WikiaLogger;

/**
 * On Special:Community we have weekly users rank with most contributions.
 * We need to reset it after every Sunday
 */

require_once( __DIR__ . '/../../Maintenance.php' );

/**
 * Class ResetWeeklyUserContributionsCount
 */
class ResetWeeklyUserContributionsCount extends Maintenance {

	public function __construct() {
		parent::__construct();
		$this->mDescription = 'reset weekly user contributions count';
	}

	public function execute() {
		global $wgCityId, $wgEnableCommunityPageExt;

		$dbw = wfGetDB( DB_MASTER );

		$userIds = ( new WikiaSQL() )
			->SELECT( 'wup_user' )
			->FROM( 'wikia_user_properties' )
			->WHERE( 'wup_property' )->EQUAL_TO( 'editcountThisWeek' )
			->run( $dbw );

		$result = ( new WikiaSQL() )
			->DELETE( 'wikia_user_properties' )
			->WHERE( 'wup_property' )->EQUAL_TO( 'editcountThisWeek' )
			->run( $dbw );

		if ( $result === false ) {
			WikiaLogger::instance()->error( 'Reset Weekly Contributions Count' );
		} else {
			foreach ( $userIds as $id ) {
				UserStatsService::purgeOptionsWikiCache( $id, $wgCityId );
			}

			if ( $wgEnableCommunityPageExt ) {
				WikiaDataAccess::cachePurge( wfMemcKey( CommunityPageSpecialUsersModel::TOP_CONTRIB_MCACHE_KEY ) );
			}

			WikiaLogger::instance()->info( 'Reset Weekly Contributions Count' );
		}
	}
}

$maintClass = 'ResetWeeklyUserContributionsCount';
require_once( RUN_MAINTENANCE_IF_MAIN );
