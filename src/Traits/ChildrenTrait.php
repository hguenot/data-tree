<?php

/**
 * @author  Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree\Traits;

use InvalidArgumentException;
use LogicException;
use OutOfRangeException;
use TS\Data\Tree\Interfaces\MutableNode;
use TS\Data\Tree\Interfaces\Node;

/**
 * @see MutableNode
 */
trait ChildrenTrait {

	/** @var Node[] */
	private $node_children = [];

	/** @var int|null */
	private $node_childIndex;

	/** @var Node|null */
	private $node_parent;

	/**
	 * Get the parent node.
	 *
	 * @return Node|null
	 */
	public function getParent(): ?Node {
		return $this->node_parent;
	}

	/**
	 * Add the given node at the end.
	 *
	 * @param mixed $node Node to be added as child of current
	 *
	 * @return Node Current node
	 */
	public function addChild(Node $node): Node {
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
	 * @return Node Current node
	 */
	public function insertChildAt(int $index, Node $node): Node {
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

		/**@var Node $this */
		return $this;
	}

	/**
	 * Remove the given child node.
	 *
	 * @param mixed $node Node to remove
	 *
	 * @throws \InvalidArgumentException If node to remove is not a child of current node
	 *
	 * @return Node Current node
	 */
	public function removeChild(Node $node): Node {
		if ($node->getParent() !== $this) {
			$msg = sprintf('Cannot remove %s from %s because it is not a child.', $node, $this);
			throw new InvalidArgumentException($msg);
		}
		$this->removeChildAt($node->getChildIndex());

		/**@var Node $this */
		return $this;
	}

	/**
	 * Remove this node from its parent.
	 *
	 * @throws LogicException If current node is not a child
	 *
	 * @return Node Current node
	 */
	public function remove(): Node {
		$p = $this->getParent();
		if (null == $p) {
			throw new LogicException();
		}
		if ($p instanceof MutableNode)
			$p->removeChildAt($this->getChildIndex());
		else
			throw new LogicException('Could not remove child of a readonly node');

		/**@var Node $this */
		return $this;
	}

	/**
	 * Remove the child node at the specified index.
	 *
	 * @param int $index Index of the child node to remove
	 *
	 * @throws \OutOfRangeException If specified index is out of range
	 *
	 * @return Node Removed node
	 */
	public function removeChildAt(int $index): Node {
		$node = $this->getChildAt($index);
		/** @var ChildrenTrait $node */

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
	 * @return Node The child node
	 */
	public function getChildAt(int $index): Node {
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
	 * @return Node[] Children nodes
	 */
	public function getChildren(): array {
		return array_merge([], $this->node_children);
	}

}
