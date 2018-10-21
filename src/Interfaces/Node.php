<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\ChildrenTrait;

/**
 * @see ChildrenTrait
 */
interface Node {

	/**
	 * Get parent node.
	 *
	 * @return Node|null Parent node
	 */
	public function getParent(): ?Node;

	/**
	 * Get all children.
	 *
	 * @return Node[] Children nodes
	 */
	public function getChildren(): array;

	/**
	 * Get the child at the specified index.
	 *
	 * @param int $index Index of the requested node
	 *
	 * @throws \OutOfRangeException If specified index is out of range
	 *
	 * @return Node The child node
	 */
	function getChildAt(int $index): Node;

	/**
	 * Get the index of this node in the list of children of its parent.
	 *
	 * @throws \LogicException If current node is not a child
	 *
	 * @return int|null
	 */
	function getChildIndex(): ?int;

}