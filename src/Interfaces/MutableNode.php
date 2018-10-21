<?php

namespace TS\Data\Tree\Interfaces;

interface MutableNode extends Node {

	/**
	 * Remove the child node at the specified index.
	 *
	 * @param int $index Index of the child node to remove
	 *
	 * @throws \OutOfRangeException If specified index is out of range
	 *
	 * @return Node Removed node
	 */
	public function removeChildAt(int $index): Node;

	/**
	 * Remove the given child node.
	 *
	 * @param mixed $node Node to remove
	 *
	 * @throws \InvalidArgumentException If node to remove is not a child of current node
	 *
	 * @return Node Current node
	 */
	public function removeChild(Node $node): Node;

	/**
	 * Remove this node from its parent.
	 *
	 * @throws \LogicException If current node is not a child
	 *
	 * @return Node Current node
	 */
	public function remove(): Node;

	/**
	 * Add the given node at the end.
	 *
	 * @param mixed $node Node to be added as child of current
	 *
	 * @return Node Current node
	 */
	public function addChild(Node $node): Node;

	/**
	 * Add the given node at the specified index, moving all children after this index back.
	 *
	 * @param int   $index Position of the new child node
	 * @param mixed $node  Child node to be inserted
	 *
	 * @throws \LogicException If new child already linked to any parent
	 * @throws \OutOfRangeException If `$index` is out of range
	 *
	 * @return Node Current node
	 */
	public function insertChildAt(int $index, Node $node): Node;
}