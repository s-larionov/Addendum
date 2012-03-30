<?php

class Annotation_Matcher_Values extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Value_Top);
		$this->add(new Annotation_Matcher_Hash);
	}
}
