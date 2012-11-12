<?php
/**
 * @author ADi
 */
class SDElementProperty extends SDRenderableObject implements SplObserver {
	/**
	 * @var SDElementPropertyType
	 */
	protected $type = null;
	protected $name = null;
	protected $value = null;
	protected $label = '';

	function __construct($name, $value, SDElementPropertyType $type = null) {
		$this->name = $name;
		$nameParts = explode( ':', $name );
		$this->label = count($nameParts) > 1 ? $nameParts[1] : $name;
		$this->value = $value;

		if($type instanceof SDElementPropertyType) {
			$this->type = $type;
		}
		else {
			$this->type = F::build( 'SDElementPropertyType' );
		}
	}

	/**
	 * set property type
	 * @param SDElementPropertyType $type
	 */
	public function setType( SDElementPropertyType $type ) {
		$this->type = $type;
	}

	/**
	 * get property type
	 * @return SDElementPropertyType
	 */
	public function getType() {
		return $this->type;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getValue() {
		if ( $this->isCollection() ) {
			if (!is_array( $this->value )) {
				if ( empty( $this->value ) ) return array();
				return array( $this->value );
			} else {
				if ((count($this->value) == 1) && (empty($this->value[0]))) return array();
			}
		}

		return $this->value;
	}

	public function isCollection() {
		return $this->getType()->isCollection();
	}

	public function getValueObject() {
		$value = $this->getValue();
		$type = $this->getType();
		if ( !$this->isCollection()) {
			return F::build( 'SDValueObject', array( 'type' => $this->getType(), 'value' => $value, 'propertyName' => $this->getName() ) );
		}
		$result = array();
		foreach($value as $v) {
			return F::build( 'SDValueObject', array( 'type' => $this->getType(), 'value' => $v, 'propertyName' => $this->getName() ) );
		}
		return $result;

	}

	public function hasNoValue() {
		$value = $this->getValue();
		return ( empty($value) ) ? true : false;
	}

	public function expandValue(StructuredData $structuredData, $elementDepth) {
		$value = $this->value;
		if(is_object($value) && isset($value->id)) {
			$value = array( $value );
		}

		if(is_array($value)) {
			foreach($value as $v) {
				if(isset($v->id)) {
					try {
						$SDElement = $structuredData->getSDElementById($v->id, $elementDepth+1);
						$v->object = $SDElement;
					}
					catch(WikiaException $e) {
						$v->object = null;
					}
				}
			}
		}
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function getLabel() {
		return $this->label;
	}

	public function toArray() {
		if($this->value instanceof SDElement) {
			$array = $this->value->toArray();
		}
		else {
			$array = array(
				'type' => $this->getTypeName(),
				'name' => $this->name,
				'label' => $this->label,
				'value' => $this->value //$this->getValues()
			);
		}

		return $array;
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Receive update from subject
	 * @link http://php.net/manual/en/splobserver.update.php
	 * @param SplSubject|SDElement $subject <p>
	 * The <b>SplSubject</b> notifying the observer of an update.
	 * </p>
	 * @return void
	 */
	public function update(SplSubject $subject) {
		$type = $subject->getContext()->getType( $this->name );
		$guessType = true;
		if($type) {
			$this->type = F::build( 'SDElementPropertyType', array( 'name' => $type['name'], 'range' => $type['range'] ) );
			$guessType = false;
		}

		if(!$this->getType()->hasRange()) {
			$propertyDescription = $subject->getContext()->getPropertyDescription( $subject->getType(), $this->name );
			if(is_object($propertyDescription) && isset($propertyDescription->range) && (count($propertyDescription->range) > 0)) {
				if ( $guessType && (count($propertyDescription->range) == 1) ) {
					if ($propertyDescription->range[0]->id == "rdfs:Literal") {
						$this->getType()->setName( $propertyDescription->range[0]->id );
					}
				}
				$this->getType()->setRange( F::build( 'SDElementPropertyTypeRange', array( 'data' => $propertyDescription->range ) ) );
			}
		}
	}

	public function getTypeName() {
		return $this->getType()->getName();
	}

	public function getRendererNames() {
		return array( $this->getName(), $this->getTypeName() );
	}
}
