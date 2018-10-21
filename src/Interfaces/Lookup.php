<?php

namespace TS\Data\Tree\Interfaces;

use TS\Data\Tree\Traits\LookupTrait;

/**
 * @method Node|null descendant(?callable $where) Find a specific descendant (the first one for which the given callable returns true).
 * @method Node|null ancestor(?callable $where) Find a specific ancestor (the first one for which the given callable returns true).
 * @method Node|null child(?callable $where) Find a specific child (the first one for which the given callable returns true).
 * @method Node|null sibling(?callable $where) Find a specific sibling (the first one for which the given callable returns true).
 * @method \Generator children(?callable $where) Create a Generator (usable with foreach) that lists all children for which the given callable returns true.
 * @method \Generator ancestors(?callable $where) Create a Generator (usable with foreach) that lists all ancestors for which the given callable returns true.
 * @method \Generator descendants(?callable $where) Create a Generator (usable with foreach) that lists all descendants for which the given callable returns true.
 * @method Node findRootNode(?callable $where) Find the root node.
 *
 * @see LookupTrait
 */
interface Lookup extends Node {

}