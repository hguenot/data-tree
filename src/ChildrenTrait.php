<?php

/**
 * @author  Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;

use InvalidArgumentException;
use LogicException;
use OutOfRangeException;

trait ChildrenTrait {

	private $node_children = [];

	private $node_childIndex;

	private $node_parent;

	/**
	 * Get the parent node.
	 *
	 * @return INode|null
	 */
	public function getParent(): ?INode {
		return $this->node_parent;
	}

	/**
	 * Add the given node at the end.
	 *
	 * @param mixed $node Node to be added as child of current
	 *
	 * @return self Current node
	 */
	public function addChild(self $node): self {
		$index = count($this->node_children);

		return $this->insertChildAt($index, $node);
	}

	/**
	 * Add the given node at the specified index, moving all children after this index back.
	 *
	 * @param int   $index Position of the new child node
	 * @param mixed $node  Child node to be inserted
	 *
	 * @throws \LogicException If new child already linked to any parent
	 * @throws \OutOfRangeException If `$index` is out of range
	 *
	 * @return self Current node
	 */
	public function insertChildAt(int $index, self $node): self {
		if ($node->getParent() != null) {
			$msg = sprintf('Cannot add %s to %s because it already is a child of %s', $node, $this, $node->getParent());
			throw new LogicException($msg);
		}
		if ($index < 0) {
			throw new OutOfRangeException();
		}
		if ($index > count($this->node_children)) {
			throw new OutOfRangeException();
		}

		// re-wire new node and insert
		$node->node_parent = $this;
		$node->node_childIndex = $index;
		array_splice(
			$this->node_children,
			$index,
			0,
			[
				$node
			]
		);

		// update following child indices
		for ($i = $index; $i < count($this->node_children); $i++) {
			$this->node_children[$i]->childIndex = $i;
		}

		return $this;
	}

	/**
	 * Remove the given child node.
	 *
	 * @param mixed $node Node to remove
	 *
	 * @throws \InvalidArgumentException If node to remove is not a child of current node
	 *
	 * @return self Current node
	 */
	public function removeChild(self $node): self {
		if ($node->getParent() !== $this) {
			$msg = sprintf('Cannot remove %s from %s because it is not a child.', $node, $this);
			throw new InvalidArgumentException($msg);
		}
		$this->removeChildAt($node->getChildIndex());

		return $this;
	}

	/**
	 * Remove this node from its parent.
	 *
	 * @throws LogicException If current node is not a child
	 *
	 * @return self Current node
	 */
	public function remove(): self {
		$p = $this->getParent();
		if (null == $p) {
			throw new LogicException();
		}
		$p->removeChildAt($this->getChildIndex());

		return $this;
	}

	/**
	 * Remove the child node at the specified index.
	 *
	 * @param int $index Index of the child node to remove
	 *
	 * @throws \OutOfRangeException If specified index is out of range
	 *
	 * @return self Removed node
	 */
	public function removeChildAt($index): self {
		$node = $this->getChildAt($index);

		// re-wire new node and remove
		$node->node_parent = null;
		$node->node_childIndex = null;
		array_splice($this->node_children, $index, 1);

		// update following child indices
		for ($i = $index; $i < count($this->node_children); $i++) {
			$this->node_children[$i]->node_childIndex = $i;
		}

		return $node;
	}

	/**
	 * Get the index of this node in the list of children of its parent.
	 *
	 * @throws LogicException If current node is not a child
	 *
	 * @return int|null
	 */
	public function getChildIndex(): ?int {
		$p = $this->getParent();
		if (null == $p) {
			throw new LogicException();
		}

		return $this->node_childIndex;
	}

	/**
	 * Get the child at the specified index.
	 *
	 * @param int $index Index of the requested node
	 *
	 * @throws \OutOfRangeException If specified index is out of range
	 *
	 * @return self The child node
	 */
	public function getChildAt(int $index): self {
		if ($index < 0) {
			throw new OutOfRangeException();
		}
		if ($index >= count($this->node_children)) {
			throw new OutOfRangeException();
		}

		return $this->node_children[$index];
	}

	/**
	 * Get all children.
	 *
	 * @return INode[] Children nodes
	 */
	public function getChildren(): array {
		return array_merge([], $this->node_children);
	}

}
