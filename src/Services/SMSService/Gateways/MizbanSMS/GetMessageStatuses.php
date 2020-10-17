<?php

class GetMessageStatuses
{

    /**
     * @var Long[] $id
     * @access public
     */
    public $id = null;

    /**
     * @param Long[] $id
     * @access public
     */
    public function __construct($id)
    {
      $this->id = $id;
    }

}
