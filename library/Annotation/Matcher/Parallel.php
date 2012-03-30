<?php

class Annotation_Matcher_Parallel extends Annotation_Matcher_Composite {
	protected function match($string, &$value) {
		$maxLength = false;
		$result = null;
		foreach($this->matchers as $matcher) {
			$subvalue = null;
			$length = $matcher->matches($string, $subvalue);
			if($maxLength === false || $length > $maxLength) {
				$maxLength = $length;
				$result = $subvalue;
			}
		}
		$value = $this->process($result);
		return $maxLength;
	}


	protected function process($value) {
		return $value;
	}
}
