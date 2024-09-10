<?php 
namespace model;

class Outgoingmail {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>