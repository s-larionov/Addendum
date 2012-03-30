<?php

class Annotation_Matcher_Value_InArray extends Annotation_Matcher_Value {
	public function process($value) {
		return array($value);
	}
}
