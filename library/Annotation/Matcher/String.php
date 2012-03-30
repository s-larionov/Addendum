<?php

class Annotation_Matcher_String extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_String_SingleQuoted);
		$this->add(new Annotation_Matcher_String_DoubleQuoted);
	}
}
