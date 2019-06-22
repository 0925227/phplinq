<?php

class BaseNode extends Node {

    function __construct() {
        $this->tail = new EmptyNode();
        $this->empty = true;
    }

    public function Add($head) {
        if($this->empty) {
            $this->_head = $head;
            $this->empty = false;
        } else if($this->tail->empty) {
            $this->tail = new Node($head);
        } else {
            $this->tail->Add($head);
        }
    }

    // Append a node to the end of the node list
    public function AddNode(Node $node) {
        if($this->empty) {
            $this->_head = $node->_head;
            $this->tail = $node->tail;
        } else if($this->tail->empty) {
            $this->tail = new Node($node->head);
            $this->tail->tail = $node->tail;
        } else {
            $this->tail->AddNode($node);
        }
    }

    // Append a array to the end of the node list
    public function AddArray(array $array) {
        if($this->empty) {
            $this->_head = $array[0];
            $this->tail = new Node($array[1]);
            for($i = 2; $i < count($array); $i++) {
                $this->tail->Add($array[$i]);
            }
        } else if($this->tail->empty) {
            $this->tail = new Node($array[0]);
            for($i = 1; $i < count($array); $i++) {
                $this->tail->Add($array[$i]);
            }
        } else {
            $this->tail->AddArray($array);
        }
    }
}