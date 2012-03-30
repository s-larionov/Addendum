<?php

class Reflection_AnnotatedClass extends ReflectionClass {
	private $annotations;

	/**
	 * @param string $class
	 */
	public function __construct($class) {
		parent::__construct($class);
		$this->annotations = $this->createAnnotationBuilder()->build($this);
	}

	/**
	 * @param string $class
	 * @return boolean
	 */
	public function hasAnnotation($class) {
		return $this->annotations->hasAnnotation($class);
	}

	/**
	 * @param string $annotation
	 * @return bool|mixed
	 */
	public function getAnnotation($annotation) {
		return $this->annotations->getAnnotation($annotation);
	}

	public function getAnnotations() {
		return $this->annotations->getAnnotations();
	}

	/**
	 * @param bool $restriction
	 * @return array
	 */
	public function getAllAnnotations($restriction = false) {
		return $this->annotations->getAllAnnotations($restriction);
	}

	/**
	 * @return null|object|Reflection_AnnotatedMethod
	 */
	public function getConstructor() {
		return $this->createReflectionAnnotatedMethod(parent::getConstructor());
	}

	/**
	 * @param string $name
	 * @return null|Reflection_AnnotatedMethod|ReflectionMethod
	 */
	public function getMethod($name) {
		return $this->createReflectionAnnotatedMethod(parent::getMethod($name));
	}

	/**
	 * @param null|string $filter
	 * @return Reflection_AnnotatedProperty[]
	 */
	public function getMethods($filter = -1) {
		$result = array();
		foreach(parent::getMethods($filter) as $method) {
			$result[] = $this->createReflectionAnnotatedMethod($method);
		}
		return $result;
	}

	/**
	 * @param string $name
	 * @return null|Reflection_AnnotatedProperty|ReflectionProperty
	 */
	public function getProperty($name) {
		return $this->createReflectionAnnotatedProperty(parent::getProperty($name));
	}

	/**
	 * @param int|null|string $filter
	 * @return \Reflection_AnnotatedProperty[]|\ReflectionProperty[]
	 */
	public function getProperties($filter = -1) {
		$result = array();
		foreach(parent::getProperties($filter) as $property) {
			$result[] = $this->createReflectionAnnotatedProperty($property);
		}
		return $result;
	}

	/**
	 * @return Reflection_AnnotatedClass[]
	 */
	public function getInterfaces() {
		$result = array();
		foreach(parent::getInterfaces() as $interface) {
			$result[] = $this->createReflectionAnnotatedClass($interface);
		}
		return $result;
	}

	/**
	 * @return bool|Reflection_AnnotatedClass|ReflectionClass
	 */
	public function getParentClass() {
		$class = parent::getParentClass();
		return $this->createReflectionAnnotatedClass($class);
	}

	/**
	 * @return Annotation_Builder
	 */
	protected function createAnnotationBuilder() {
		return new Annotation_Builder();
	}

	/**
	 * @param \ReflectionClass $class
	 * @return bool|Reflection_AnnotatedClass
	 */
	private function createReflectionAnnotatedClass(ReflectionClass $class) {
		return ($class !== false)? new Reflection_AnnotatedClass($class->getName()): false;
	}

	/**
	 * @param \ReflectionMethod $method
	 * @return null|Reflection_AnnotatedMethod
	 */
	private function createReflectionAnnotatedMethod(ReflectionMethod $method) {
		return ($method !== null)? new Reflection_AnnotatedMethod($this->getName(), $method->getName()): null;
	}

	/**
	 * @param \ReflectionProperty $property
	 * @return null|Reflection_AnnotatedProperty
	 */
	private function createReflectionAnnotatedProperty(ReflectionProperty $property) {
		return ($property !== null)? new Reflection_AnnotatedProperty($this->getName(), $property->getName()): null;
	}
}
