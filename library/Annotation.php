<?php
/**
 * Addendum PHP Reflection Annotations
 * http://code.google.com/p/addendum/
 *
 * Copyright (C) 2006-2009 Jan "johno Suchal <johno@jsmf.net>

 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.

 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.

 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 **/

class Annotation {
	public $value;
	private static $creationStack = array();

	public final function __construct(array $data = array(), $target = false) {
		$reflection = new ReflectionClass($this);
		$class = $reflection->getName();
		if(array_key_exists($class, self::$creationStack)) {
			trigger_error("Circular annotation reference on '{$class}'", E_USER_ERROR);
			return;
		}
		self::$creationStack[$class] = true;
		foreach($data as $key => $value) {
			if($reflection->hasProperty($key)) {
				$this->$key = $value;
			} else {
				trigger_error("Property '{$key}' not defined for annotation '{$class}'");
			}
		}
		$this->checkTargetConstraints($target);
		$this->checkConstraints($target);
		unset(self::$creationStack[$class]);
	}

	private function checkTargetConstraints($target) {
		$reflection = new Reflection_AnnotatedClass($this);
		if($reflection->hasAnnotation('Target')) {
			$value = $reflection->getAnnotation('Target')->value;
			$values = is_array($value) ? $value : array($value);
			foreach($values as $value) {
				if($value == 'class' && $target instanceof ReflectionClass) return;
				if($value == 'method' && $target instanceof ReflectionMethod) return;
				if($value == 'property' && $target instanceof ReflectionProperty) return;
				if($value == 'nested' && $target === false) return;
			}
			if($target === false) {
				trigger_error("Annotation '".get_class($this)."' nesting not allowed", E_USER_ERROR);
			} else {
				trigger_error("Annotation '".get_class($this)."' not allowed on ".$this->createName($target), E_USER_ERROR);
			}
		}
	}

	/**
	 * @param ReflectionMethod|ReflectionProperty|Reflection $target
	 * @return string
	 */
	private function createName($target) {
		if($target instanceof ReflectionMethod) {
			return $target->getDeclaringClass()->getName().'::'.$target->getName();
		} elseif($target instanceof ReflectionProperty) {
			return $target->getDeclaringClass()->getName().'::$'.$target->getName();
		} else {
			return $target->getName();
		}
	}

	protected function checkConstraints($target) {}
}
