<?php

namespace TS\Data\Tree;

interface INode {

	/**
	 * Get all children.
	 *
	 * @return self[] Children nodes
	 */
	public function getChildren(): array;

	/**
	 * Get parent node.
	 *
	 * @return self|null Parent node
	 */
	public function getParent(): ?self;

}