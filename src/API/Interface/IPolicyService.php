<?php

namespace Jetstream\Curacel\API\Interface;

interface IPolicyService
{
    public function getAllPolicies(array $params = []);

    public function getPolicyDocument(int $id);

    public function getPolicyResource(int $id,array $params = []);
}
