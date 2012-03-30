<?php

class Annotation_Matcher_Hash extends Annotation_Matcher_Parallel {
	protected function build() {
		$this->add(new Annotation_Matcher_Pair);
		$this->add(new Annotation_Matcher_MorePairs);
	}
}
