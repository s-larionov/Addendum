<?php

class Annotation_Builder {
	private static $cache = array();

	public function build($targetReflection) {
		$data = $this->parse($targetReflection);
		$annotations = array();
		foreach($data as $class => $parameters) {
			foreach($parameters as $params) {
				$annotation = $this->instantiateAnnotation($class, $params, $targetReflection);
				if($annotation !== false) {
					$annotations[get_class($annotation)][] = $annotation;
				}
			}
		}
		return new AnnotationsCollection($annotations);
	}


	public function instantiateAnnotation($class, $parameters, $targetReflection = false) {
		$class = Addendum::resolveClassName($class);
		if(is_subclass_of($class, 'Annotation') && !Addendum::inIgnoreList($class) || $class == 'Annotation') {
			$annotationReflection = new ReflectionClass($class);
			return $annotationReflection->newInstance($parameters, $targetReflection);
		}
		return false;
	}

	private function parse($reflection) {
		$key = $this->createName($reflection);
		if(!isset(self::$cache[$key])) {
			$parser = new Annotation_Matcher_Annotations;
			$parser->matches($this->getDocComment($reflection), $data);
			self::$cache[$key] = $data;
		}
		return self::$cache[$key];
	}

	private function createName($target) {
		if($target instanceof ReflectionMethod) {
			return $target->getDeclaringClass()->getName().'::'.$target->getName();
		} elseif($target instanceof ReflectionProperty) {
			return $target->getDeclaringClass()->getName().'::$'.$target->getName();
		} else {
			return $target->getName();
		}
	}

	protected function getDocComment($reflection) {
		return Addendum::getDocComment($reflection);
	}

	public static function clearCache() {
		self::$cache = array();
	}
}
