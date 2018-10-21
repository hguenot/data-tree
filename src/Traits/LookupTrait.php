<?php

/**
 * @author  Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */

namespace TS\Data\Tree\Traits;

use TS\Data\Tree\Interfaces\Lookup;
use TS\Data\Tree\Interfaces\Node;

trait LookupTrait {

	/**
	 * Get all children.
	 *
	 * @return Lookup[] Children nodes
	 */
	abstract public function getChildren(): array;

	/**
	 * Get parent node.
	 *
	 * @return Node|null Parent node
	 */
	abstract public function getParent(): ?Node;

	/**
	 * Find a specific descendant.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return Node|null
	 */
	public function descendant(callable $where): ?Node {
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
	 * @return Node|null
	 */
	public function ancestor(callable $where): ?Node {
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
	 * @return Node|null
	 */
	public function child(callable $where): ?Node {
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
	 * @return Node|null
	 */
	public function sibling(callable $where): ?Node {
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
	public function children(callable $where): \Generator {
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
	public function ancestors(callable $where = null): \Generator {
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
	public function descendants(callable $where = null): \Generator {
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
	public function siblings(callable $where = null): \Generator {
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
	 * @return Lookup
	 */
	public function findRootNode(): Node {
		$p = $this;
		while ($p->getParent()) {
			$p = $p->getParent();
		}

		return $p;
	}

}

