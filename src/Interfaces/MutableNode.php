<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\ChildrenTrait;

/**
 * @method Node removeChildAt(int $index) Remove the child node at the specified index.
 * @method Node removeChild(Node $node) Remove the given child node.
 * @method Node remove() Remove this node from its parent.
 * @method Node addChild(Node $node) Add the given node at the end.
 * @method Node insertChildAt(int $index, Node $node) Add the given node at the specified index, moving all children after this index back.
 *
 * @see ChildrenTrait
 */
interface MutableNode extends Node {

}