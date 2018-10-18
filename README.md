PHP Tree data structure
=======================

This library provides a tree structure via discrete Traits. 

It is intended to be used by other libraries.  

(Fork of https://github.com/timostamm/data-tree - PHP 7 support and releases)


Continuous integration
------------
[![Build Status](https://travis-ci.org/hguenot/data-tree.svg)](https://travis-ci.org/hguenot/phpstream) 
[![Code coverage](https://img.shields.io/codecov/c/github/hguenot/data-tree.svg)](https://codecov.io/github/hguenot/data-tree) 
[![GitHub version](https://img.shields.io/github/release/hguenot/data-tree.svg)](https://github.com/hguenot/data-tree/releases) 
[![Packagist version](https://img.shields.io/packagist/v/hguenot/data-tree.svg)](https://packagist.org/packages/hguenot/data-tree)

### ChildrenTrait

Add, acces and remove child nodes using this trait.

### LookupTrait

Optional methods to inspect the tree.

### AttributesTrait

Optional attributes per node.

### ToStringTrait

Optional `__toString()` implementation that outputs the nodes class name and its attributes.

### NodeTrait

Combines all of the above traits

### Protected Access

The sub-namespace `ProtectedAccess` contains versions of `ChildrenTrait`, `LookupTrait` and `AttributesTrait` where all methods are protected. This allows fine control over the public API when using the Traits in a library.


## Example

```php
// Create a simple tree.
$root = new Node();
$root->setAttribute('name', 'root');

$a = new Node();
$a->setAttribute('name', 'a');
$root->addChild($a);

$b = new Node();
$b->setAttribute('name', 'b');
$root->addChild($b);

$c = new Node();
$c->setAttribute('name', 'c');
$root->addChild($c);


// Find a descendant with the name=b
$bAgain = $root->descendant(function ($node) {
	return $node->getAttribute('name') === 'b';
});

// Get the root node of any node
$rootAgain = $bAgain->findRootNode();

// Remove a node
$bAgain->remove();
$root->removeChild($a);
$root->removeChildAt(0);
```
