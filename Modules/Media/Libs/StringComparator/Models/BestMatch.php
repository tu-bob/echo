<?php


namespace Modules\Media\Libs\StringComparators\Models;


class BestMatch
{
    public float $score;
    public $entity;

    public function __construct($score, $entity = null)
    {
        $this->score = $score;
        $this->entity = $entity;
    }
}
