<?php

/**
 * @author  Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree;

trait LookupTrait {

	/**
	 * Get all children.
	 *
	 * @return INode[] Children nodes
	 */
	abstract public function getChildren(): array;

	/**
	 * Get parent node.
	 *
	 * @return INode|null Parent node
	 */
	abstract public function getParent(): ?INode;

	/**
	 * Find a specific descendant.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return self|null
	 */
	public function descendant(callable $where): ?self {
		foreach ($this->descendants($where) as $node) {
			return $node;
		}

		return null;
	}

	/**
	 * Find a specific ancestor.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return self|null
	 */
	public function ancestor(callable $where): ?self {
		foreach ($this->ancestors($where) as $node) {
			return $node;
		}

		return null;
	}

	/**
	 * Find as specific child.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return self|null
	 */
	public function child(callable $where): ?self {
		foreach ($this->children($where) as $node) {
			return $node;
		}

		return null;
	}

	/**
	 * Find as specific sibling.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return self|null
	 */
	public function sibling(callable $where): ?self {
		foreach ($this->children($where) as $node) {
			return $node;
		}

		return null;
	}

	/**
	 * Create a Generator (usable with foreach) that lists all children for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function children(callable $where) {
		foreach ($this->getChildren() as $node) {
			if ($where($node)) {
				yield $node;
			}
		}
	}

	/**
	 * Create a Generator (usable with foreach) that lists all ancestors for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function ancestors(callable $where = null) {
		$p = $this;
		while ($p->getParent()) {
			$p = $p->getParent();
			if ($where === null || $where($p)) {
				yield $p;
			}
		}
	}

	/**
	 * Create a Generator (usable with foreach) that lists all descendants for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function descendants(callable $where = null) {
		foreach ($this->getChildren() as $child) {
			if ($where === null || $where($child)) {
				yield $child;
			}
			foreach ($child->descendants($where) as $c) {
				yield $c;
			}
		}
	}

	/**
	 * Create a Generator (usable with foreach) that lists all siblings for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function siblings(callable $where = null) {
		$p = $this->getParent();
		if ($p !== null) {
			foreach ($p->getChildren() as $child) {
				if ($child === $this) {
					continue;
				}
				if ($where === null || $where($child)) {
					yield $child;
				}
			}
		}
	}

	/**
	 * Find the root node.
	 * @return self
	 */
	public function findRootNode() {
		$p = $this;
		while ($p->getParent()) {
			$p = $p->getParent();
		}

		return $p;
	}

}

