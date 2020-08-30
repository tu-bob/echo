<?php
namespace Modules\Shared\Libs\Ulid\Contracts;

interface Factory
{
    public function generate(): string;
}
