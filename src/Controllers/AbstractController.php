<?php

namespace RichardEszes\Billingo\Controllers;

use RichardEszes\Billingo\Models\AbstractModel;

abstract class AbstractController
{
    abstract public function list($params = []): array;

    abstract public function create(): AbstractModel;

    abstract public function get(): AbstractModel;

    abstract public function getById(int $id): AbstractModel;

    abstract public function update(): AbstractModel;

    abstract public function delete(): bool;
}