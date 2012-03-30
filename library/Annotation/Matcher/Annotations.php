<?php

class Annotation_Matcher_Annotations {
	public function matches($string, &$annotations) {
		$annotations = array();
		$annotation_matcher = new Annotation_Matcher;
		while(true) {
			if(preg_match('/[\*\s](?=@)/', $string, $matches, PREG_OFFSET_CAPTURE)) {
				$offset = $matches[0][1] + 1;
				$string = substr($string, $offset);
			}  else {
				return; // no more annotations
			}
			if(($length = $annotation_matcher->matches($string, $data)) !== false) {
				$string = substr($string, $length);
				list($name, $params) = $data;
				$annotations[$name][] = $params;
			}
		}
	}
}
