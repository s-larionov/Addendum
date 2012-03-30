<?php

class Annotation_Matcher_Array_Value extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Value_InArray);
		$this->add(new Annotation_Matcher_Pair);
	}
}
