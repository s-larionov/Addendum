<?php

class Annotation_Matcher_Value extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Constant('true', true));
		$this->add(new Annotation_Matcher_Constant('false', false));
		$this->add(new Annotation_Matcher_Constant('TRUE', true));
		$this->add(new Annotation_Matcher_Constant('FALSE', false));
		$this->add(new Annotation_Matcher_Constant('NULL', null));
		$this->add(new Annotation_Matcher_Constant('null', null));
		$this->add(new Annotation_Matcher_String);
		$this->add(new Annotation_Matcher_Number);
		$this->add(new Annotation_Matcher_Array);
		$this->add(new Annotation_Matcher_StaticConstant);
		$this->add(new Annotation_Matcher_Nested);
	}
}
