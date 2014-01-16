<?php

/**
 * VideoPageToolAssetCategory Class
 */
class VideoPageToolAssetCategory extends VideoPageToolAsset {

	protected $categoryName;
	protected $displayTitle;
	protected $defaultThumbOptions = [ 'hidePlayButton' => true ];

	// required data field -- array( FormFieldName => varName )
	protected static $dataFields = array(
		'categoryName' => 'categoryName',
		'displayTitle' => 'displayTitle',
	);

	/**
	 * Get asset data (used in template)
	 * @param array $thumbOptions
	 * @return array
	 *
	 * The associative array data returned has the keys:
	 *     categoryName => Human readable title, e.g. "Soul Bubbles Nintendo DS"
	 *     displayTitle => Preferred title entered via Admin tool, e.g. "Soul Bubbles on Nintendo DS"
	 *     thumbnails   => An array of video thumbnail data of the format:
	 *          [ title => $title,
	 *            thumb => $thumb,
	 *            url   => $url,
	 *          ]
	 *     updatedBy    => Name of the user who updated this asset last
	 *     updatedAt    => Date this asset was last updated, e.g. "17:04, September 13, 2013"
	 */
	public function getAssetData( $thumbOptions = array() ) {
		$title = Title::newFromText( $this->categoryName, NS_CATEGORY );
		if ( empty( $title ) ) {
			return self::getDefaultAssetData();
		}

		// Allow defaults to be overridden by options passed into us
		$thumbOptions = array_merge( $this->defaultThumbOptions, $thumbOptions );

		$helper = new VideoPageToolHelper();
		$data = array(
			'categoryName' => $title->getText(),
			'displayTitle' => $this->displayTitle,
			'thumbnails'   => $helper->getVideosByCategory( $title, $thumbOptions ),
		);

		$assetData = array_merge( $data, parent::getAssetData( $thumbOptions ) );

		return $assetData;
	}

	/**
	 * Get default asset data (used in template)
	 * @return array $assetData
	 */
	public static function getDefaultAssetData() {
		$data = array(
			'categoryName' => '',
			'displayTitle' => '',
		);
		$defaultData = array_merge( $data, parent::getDefaultAssetData() );

		return $defaultData;
	}

	/**
	 * Format form data
	 * @param integer $requiredRows
	 * @param array $formValues
	 * @param string $errMsg
	 * @return array $data
	 */
	public static function formatFormData( $requiredRows, $formValues, &$errMsg ) {
		// set displayTitle = categoryName if displayTitle is empty
		foreach ( $formValues['displayTitle'] as $key => &$value ) {
			if ( empty( $value ) ) {
				$value = $formValues['categoryName'][$key];
			}
		}

		return parent::formatFormData( $requiredRows, $formValues, $errMsg );
	}

}
