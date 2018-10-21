<?php

namespace TS\Data\Tree\Interfaces;

interface Attributes {
	/**
	 * Set an attribute.
	 *
	 * @param string $name  Attribute name
	 * @param mixed  $value Attribute value
	 *
	 * @return Attributes
	 */
	function setAttribute(string $name, $value): Attributes;

	/**
	 * Check if an attribute is set.
	 *
	 * @param string $name Attribute name
	 *
	 * @return bool
	 */
	function hasAttribute(string $name): bool;

	/**
	 * Get an attribute value.
	 *
	 * @param string     $name    Attribute name
	 * @param mixed|null $default Default value if attribute does not exist
	 *
	 * @return mixed|null
	 */
	function getAttribute(string $name, $default = null);

	/**
	 * Remove an attribute.
	 *
	 * @param string $name
	 *
	 * @return Attributes
	 */
	function removeAttribute(string $name): Attributes;

	/**
	 * Get all attributes as an associative array.
	 *
	 * @return mixed[] Attributes value indexed by attribute name
	 */
	function getAttributes(): array;

}
