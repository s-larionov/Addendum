<?php

class Annotation_Matcher_Array_Values extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Array_Value);
		$this->add(new Annotation_Matcher_MoreValues);
	}
}
