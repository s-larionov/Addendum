<?php

class Addendum {
	/**
	 * @var boolean
	 */
	private static $rawMode;
	/**
	 * @var string[]
	 */
	private static $ignore;
	/**
	 * @var string[]
	 */
	private static $classnames = array();
	/**
	 * @var string[]|null
	 */
	private static $annotations = null;

	/**
	 * @static
	 * @param ReflectionMethod | ReflectionClass | ReflectionObject | ReflectionProperty $reflection
	 * @return bool
	 */
	public static function getDocComment($reflection) {
		if(self::checkRawDocCommentParsingNeeded()) {
			$docComment = new DocComment();
			return $docComment->get($reflection);
		} else {
			return $reflection->getDocComment();
		}
	}

	/**
	 * Raw mode test
	 * @return bool
	 */
	private static function checkRawDocCommentParsingNeeded() {
		if(self::$rawMode === null) {
			$reflection = new ReflectionClass('Addendum');
			$method = $reflection->getMethod('checkRawDocCommentParsingNeeded');
			self::setRawMode($method->getDocComment() === false);
		}
		return self::$rawMode;
	}

	/**
	 * @static
	 * @param bool $enabled
	 */
	public static function setRawMode($enabled = true) {
		self::$rawMode = (bool) $enabled;
	}

	public static function resetIgnoredAnnotations() {
		self::$ignore = array();
	}

	/**
	 * Check if class in ignore list
	 *
	 * @static
	 * @param string $class
	 * @return bool
	 */
	public static function inIgnoreList($class) {
		return isset(self::$ignore[$class]);
	}

	/**
	 * Set ignore classes list
	 *
	 * @static
	 */
	public static function setIgnoreList() {
		foreach(func_get_args() as $class) {
			self::$ignore[$class] = true;
		}
	}


	/**
	 * Resolve real class name for annotation class.
	 *
	 * @static
	 * @param string $class
	 * @return string
	 */
	public static function resolveClassName($class) {
		if(isset(self::$classnames[$class])) {
			return self::$classnames[$class];
		}

		$matching = array();
		foreach(self::getDeclaredAnnotations() as $declared) {
			if($declared == $class) {
				$matching[] = $declared;
			} else {
				$pos = strrpos($declared, "_{$class}");
				if($pos !== false && ($pos + strlen($class) == strlen($declared) - 1)) {
					$matching[] = $declared;
				}
			}
		}

		$result = null;
		switch(count($matching)) {
			case 0: $result = $class; break;
			case 1: $result = $matching[0]; break;
			default: new Annotation_Exception("Cannot resolve class name for '{$class}'. Possible matches: " . join(', ', $matching), E_USER_ERROR);
		}
		self::$classnames[$class] = $result;

		return $result;
	}


	/**
	 * Get list of classes inherited from Annotation
	 *
	 * @static
	 * @return string[]
	 */
	private static function getDeclaredAnnotations() {
		if(self::$annotations === null) {
			self::$annotations = array();
			foreach(get_declared_classes() as $class) {
				if(is_subclass_of($class, 'Annotation') || $class == 'Annotation') {
					self::$annotations[] = $class;
				}
			}
		}
		return self::$annotations;
	}

	/**
	 * @static
	 * @param string $className
	 */
	public static function declareAnnotation($className) {
		if(self::$annotations === null) {
			self::getDeclaredAnnotations();
		}
		if(is_subclass_of($className, 'Annotation') || $className == 'Annotation') {
			self::$annotations[] = $className;
		}
	}
}
