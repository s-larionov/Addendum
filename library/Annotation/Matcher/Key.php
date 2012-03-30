<?php

class Annotation_Matcher_Key extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Regex('[a-zA-Z][a-zA-Z0-9_]*'));
		$this->add(new Annotation_Matcher_String);
		$this->add(new Annotation_Matcher_Integer);
	}
}
