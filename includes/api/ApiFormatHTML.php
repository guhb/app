<?php

/*
 * Created on Oct 22, 2006
 *
 * API for MediaWiki 1.8+
 *
 * Copyright (C) 2008 Roan Kattouw <Firstname>.<Lastname>@home.nl
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	// Eclipse helper - will be ignored in production
	require_once ( 'ApiFormatBase.php' );
}

/**
 * @ingroup API
 */
class ApiFormatHTML extends ApiFormatBase {

	public function __construct( $main, $format ) {
		parent :: __construct( $main, $format );
	}

	public function getMimeType() {
		return 'text/html';
	}

	public function execute() {
		$data = $this->getResultData();
		$this->printText( end ( end( $data ) ) );
	}

	public function getDescription() {
		return 'Output data in HTML format' . parent :: getDescription();
	}

	public function getVersion() {
		return __CLASS__ . ': $Id: HTML outputer jolek ';
	}
}
