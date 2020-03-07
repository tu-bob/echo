<?php


namespace Modules\Media\Libs\Request\RequestWriter;


abstract class RequestWriter
{
    protected ?array $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    abstract function write();
}
