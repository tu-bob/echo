<?php
namespace App\Libs\Ulid\Contracts;

interface Factory
{
    public function generate(): string;
}
