<?php

namespace TS\Data\Tree;

use TS\Data\Tree\Interfaces\Lookup;
use TS\Data\Tree\Interfaces\MutableNode;
use TS\Data\Tree\Interfaces\Attributes;
use TS\Data\Tree\Traits\NodeTrait;

class Node implements Lookup, MutableNode, Attributes {

	use NodeTrait;

}

