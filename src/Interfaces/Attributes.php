<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\AttributesTrait;

/**
 * @method Attributes setAttribute(string $name, $value) Set an attribute.
 * @method Attributes removeAttribute(string $name) Remove an attribute.
 * @method bool hasAttribute(string $name, $value) Check if an attribute is set.
 * @method mixed|null getAttribute(string $name, $default = null) Get an attribute value.
 * @method mixed[] getAttributes() Get all attributes as an associative array.
 *
 * @see AttributesTrait
 */
interface Attributes {
	
}
