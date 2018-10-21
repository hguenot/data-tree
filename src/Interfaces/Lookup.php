<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\LookupTrait;

/** @see LookupTrait */
interface Lookup extends Node {

	/**
	 * Find a specific descendant.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return Node|null
	 */
	public function descendant(callable $where): ?Node;

	/**
	 * Find a specific ancestor.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return Node|null
	 */
	public function ancestor(callable $where): ?Node;

	/**
	 * Find as specific child.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return Node|null
	 */
	public function child(callable $where): ?Node;

	/**
	 * Find as specific sibling.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return Node|null
	 */
	public function sibling(callable $where): ?Node;

	/**
	 * Create a Generator (usable with foreach) that lists all children for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function children(callable $where): \Generator;

	/**
	 * Create a Generator (usable with foreach) that lists all ancestors for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function ancestors(callable $where = null): \Generator;

	/**
	 * Create a Generator (usable with foreach) that lists all descendants for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function descendants(callable $where = null): \Generator;

	/**
	 * Create a Generator (usable with foreach) that lists all siblings for which the given callable returns true.
	 *
	 * @param callable $where Called with a node as single argument, must return true or false.
	 *
	 * @return \Generator
	 */
	public function siblings(callable $where = null): \Generator;

	/**
	 * Find the root node.
	 * @return Node
	 */
	public function findRootNode(): Node;


}