<?php

$comments = Array
(
    '0' => Array
    (
        'id' => 1,
        'content' => 'co1',
        'author_id' => 2,
        'date' => 1,
        'parent_id' => 0
    ),

    '1' => Array
    (
        'id' => 2,
        'content' => 'co2',
        'author_id' => 2,
        'date' => 2,
        'parent_id' => 0
    ),

    '2' => Array
    (
        'id' => 3,
        'content' => 'co3',
        'author_id' => 3,
        'date' => 3,
        'parent_id' => 1
    ),

    '3' => Array
    (
        'id' => 4,
        'content' => 'co4',
        'author_id' => 4,
        'date' => 4,
        'parent_id' => 0
    ),

    '4' => Array
    (
        'id' => 5,
        'content' => 'co5',
        'author_id' => 5,
        'date' => 5,
        'parent_id' => 3
    ),

    '5' => Array
    (
        'id' => 6,
        'content' => 'co6',
        'author_id' => 6,
        'date' => 6,
        'parent_id' => 1
    ),

    '6' => Array
    (
        'id' => 7,
        'content' => 'co7',
        'author_id' => 7,
        'date' => 7,
        'parent_id' => 3
    ),

    '7' => Array
    (
        'id' => 8,
        'content' => 'co8',
        'author_id' => 8,
        'date' => 8,
        'parent_id' => 5
    ),

    '8' => Array
    (
        'id' => 9,
        'content' => 'co9',
        'author_id' => 9,
        'date' => 9,
        'parent_id' => 8
    ),

    '9' => Array
    (
        'id' => 10,
        'content' => 'co10',
        'author_id' => 10,
        'date' => 10,
        'parent_id' => 3
    ),

    '9' => Array
    (
        'id' => 10,
        'content' => 'co10',
        'author_id' => 10,
        'date' => 10,
        'parent_id' => 3
    )
);

class Node
{
    public $children = [];
    public $remove_list = [];

    public function __construct(Array $all_array)
    {
        foreach ($all_array as $id => $item) {
            $item['children'] = [];
            $this->children[$item['id']] = $item;
        }
        $this->sort();
    }

    public function addToParent($item)
    {

        if ($item['parent_id'] > 0 && $item['parent_id'] != $item['id']) {
            if (isset($this->children[$item['parent_id']])) {
                $this->children[$item['parent_id']]['children'][$item['id']] = $item;
                $this->addToParent($this->children[$item['parent_id']]);
                $this->remove_list[] = $item['id'];
            }
        }
    }

    public function sort()
    {
        foreach ($this->children as $id => $child) {
            $this->addToParent($child);
        }
        $this->removeExtra();
    }

    public function removeExtra()
    {
        foreach ($this->remove_list as $item_id) {
            unset($this->children[$item_id]);
        }
    }
}


$nodes = new Node($comments);
print_r($nodes->children);
