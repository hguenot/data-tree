<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\ChildrenTrait;

/**
 * Interface Node
 * @method Node|null getParent() Get parent node
 * @method Node[] getChildren() Get all children
 * @method Node getChildAt(int $index) Get the child at the specified index.
 * @method int|null getChildIndex() Get the index of this node in the list of children of its parent.
 *
 * @see ChildrenTrait
 */
interface Node {

}