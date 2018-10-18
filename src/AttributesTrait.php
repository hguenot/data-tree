<?php

/**
 * @author  Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;

trait AttributesTrait {

	private $node_attributes = [];

	/**
	 * Set an attribute.
	 *
	 * @param string $name  Attribute name
	 * @param mixed  $value Attribute value
	 *
	 * @return self
	 */
	public function setAttribute(string $name, $value): self {
		$this->node_attributes[$name] = $value;

		return $this;
	}

	/**
	 * Check if an attribute is set.
	 *
	 * @param string $name Attribute name
	 *
	 * @return bool
	 */
	public function hasAttribute(string $name): bool {
		return array_key_exists($name, $this->node_attributes);
	}

	/**
	 * Get an attribute value.
	 *
	 * @param string     $name    Attribute name
	 * @param mixed|null $default Default value if attribute does not exist
	 *
	 * @return mixed
	 */
	public function getAttribute(string $name, $default = null) {
		return array_key_exists($name, $this->node_attributes) ? $this->node_attributes[$name] : $default;
	}

	/**
	 * Remove an attribute.
	 *
	 * @param string $name
	 *
	 * @return self
	 */
	public function removeAttribute(string $name): self {
		if ($this->hasAttribute($name)) {
			unset($this->node_attributes[$name]);
		}

		return $this;
	}

	/**
	 * Get all attributes as an associative array.
	 *
	 * @return mixed[] Attributes value indexed by attribute name
	 */
	public function getAttributes(): array {
		return array_merge([], $this->node_attributes);
	}

}
