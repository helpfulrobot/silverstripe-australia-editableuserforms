<?php

/**
 * A text field that allows a user to specify a default value
 *
 * @author Marcus Nyeholt <marcus@silverstripe.com.au>
 */
class EditableMaskedTextField extends EditableTextFieldWithDefault
{
    static $singular_name = 'Masked Text field';

	static $plural_name = 'Masked Text fields';

	public function Icon() {
		return 'editableuserforms/images/maskedtextfield.png';
	}

	function getFieldConfiguration() {
		$fields = parent::getFieldConfiguration();
		// eventually replace hard-coded "Fields"?
		$baseName = "Fields[$this->ID]";

		$mask = $this->getSetting('TextMask');

		$extraFields = new FieldSet(
			new TextField($baseName . "[CustomSettings][TextMask]", _t('EditableMaskedTextFieldWithDefault.MASK', 'Mask'), $mask),
			new LiteralField('MaskInstructions', _t('EditableMaskedTextFieldWithDefault.MASK_INSTRUCTIONS', 'Example: 99/99/9999 <ul><li>a - Represents an alpha character (A-Z,a-z)</li><li>9 - Represents a numeric character (0-9)</li><li>* - Represents an alphanumeric character (A-Z,a-z,0-9)</li></ul>'))
		);

		$fields->merge($extraFields);
		return $fields;
	}

	function getFormField($properties = array()) {
		$field = parent::getFormField('MaskedTextField');

		$field->setInputMask($this->getSetting('TextMask'));

		return $field;
	}
}