<?php

class Annotation_Matcher_Array extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Constant('{}', array()));
		$values_matcher = new Annotation_Matcher_Serial_Simple(1);
		$values_matcher->add(new Annotation_Matcher_Regex('\s*{\s*'));
		$values_matcher->add(new Annotation_Matcher_Array_Values);
		$values_matcher->add(new Annotation_Matcher_Regex('\s*}\s*'));
		$this->add($values_matcher);
	}
}
