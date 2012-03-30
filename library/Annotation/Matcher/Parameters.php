<?php

class Annotation_Matcher_Parameters extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Constant('', array()));
		$this->add(new Annotation_Matcher_Constant('\(\)', array()));
		$params_matcher = new Annotation_Matcher_Serial_Simple(1);
		$params_matcher->add(new Annotation_Matcher_Regex('\(\s*'));
		$params_matcher->add(new Annotation_Matcher_Values);
		$params_matcher->add(new Annotation_Matcher_Regex('\s*\)'));
		$this->add($params_matcher);
	}
}
