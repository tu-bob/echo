<?php


namespace Modules\Shared\Http\Requests;


abstract class RequestWriter
{
    protected ?array $request;

    protected $entityClass;

    protected $entity;

    public function __construct($request = null, $entityClass = null)
    {
        $this->request = $request;
        $this->entityClass = $entityClass;
    }

    abstract function write();

    protected function createOrUpdate($data)
    {
        if (isset($this->request['id'])) {
            $this->entity = $this->entityClass::findOrFail($this->request['id']);
            $this->entity->update($data);
        } else
            $this->entity = $this->entityClass::create($data);
    }
}
