<?php

class Annotation_Matcher_Value_Top extends Annotation_Matcher_Value {
	protected function process($value) {
		return array('value' => $value);
	}
}
