<?php

class Node {
    public $_head;

    public $tail;
    public $empty;

    function __construct($head) {
        $this->_head = $head;
        $this->tail = new EmptyNode();

        $this->empty = false;
    }

    public function Add($head) {
        if($this->tail->empty) {
            $this->tail = new Node($head);
        } else {
            $this->tail->Add($head);
        }
    }

    // Append a node to the end of the node list
    public function AddNode(Node $node) {
        if($this->tail->empty) {
            $this->tail = new Node($node->_head);
            $this->tail->tail = $node->tail;
        } else {
            $this->tail->AddNode($node);
        }
    }

    // Append a array to the end of the node list
    public function AddArray(array $array) {
        if($this->tail->empty) {
            $this->tail = new Node($array[0]);
            for($i = 1; $i < count($array); $i++) {
                $this->tail->Add($array[$i]);
            }
        } else {
            $this->tail->AddArray($array);
        }
    }

    public function Count() {
        if($this->tail->empty) {
            return 1;
        } else {
            return 1 + $this->tail->Count();
        }
    }

    public function ElementAt(int $index) {
        if($index == 0) {
            return $this->_head;
        }
        if(!$this->tail->empty) {
            return $this->tail->ElementAt($index - 1);
        }
        throw new Exception("Index out of bounds");
    }

    public function Map(callable $mapping, Node $node = null) {
        // Return a new NodeList with mapping applied
        if(!$this->empty) {
            if($node == null) {
                $node = new BaseNode();
            }
            $node->Add($mapping($this->_head));
            if($this->tail->empty) {
                return $node;
            } else {
                return $this->tail->Map($mapping, $node);
            }
        }
    }

    public function Where(callable $operator, Node $node = null) {
        // Return a new Nodelist with
        if(!$this->empty) {
            if($node == null) {
                $node = new BaseNode();
            }
            if($operator($this->_head)) {
                $node->Add($this->_head);
            }
            if($this->tail->empty) {
                return $node;
            } else {
                return $this->tail->Where($operator, $node);
            }
         }
    }

    public function ToArray($array = array()) {
        // Generate Array from the nodelist
        $array[] = $this->_head;
        if($this->tail->empty) {
            return $array;
        } else {
            return $this->tail->ToArray($array);
        }
    }
}