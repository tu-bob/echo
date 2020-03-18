<?php


namespace Modules\Shared\Http\Requests;


abstract class RequestWriter
{
    protected ?array $request;

    protected $entity;

    public function __construct($request = null,$entity = null)
    {
        $this->request = $request;
        $this->entity = $entity;
    }

    abstract function write();

    protected function createOrUpdate($data)
    {
        if (isset($this->request['id'])) {
            $this->song = $this->entity::findOrFail($this->request['id']);
            $this->song->update($data);
        } else
            $this->song = $this->entity::create($data);
    }
}
