<?php

class Base extends Eloquent {

	/**
	 * Forms an assoc array of values to use in a <select> element
	 *
	 * @return Array 
	 */
	protected static function getSelectFields(array $fieldNames)
	{
		$fields = array();
		$field = "";

		foreach (self::all() as $value) {  
			foreach($fieldNames as $fieldName) {
				$field .= $value->$fieldName . " ";  
			}

			$fields[$value->id] = $field;
			$field = "";
		}

		return $fields;
	}

}
