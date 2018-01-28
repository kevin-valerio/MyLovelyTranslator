<?php

class Translation
{
    private $id;
    private $expression;

    public function __construct($id, $expr)
    {
        $this->id = $id;
        $this->expression = $expr;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getExpression()
    {
        return $this->expression;
    }


}