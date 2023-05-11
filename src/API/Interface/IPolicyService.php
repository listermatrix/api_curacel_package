<?php

namespace Jetstream\Curacel\API\Interface;

interface IPolicyService
{
    public function getAllPolicies(array $params = []);

    public function getPolicyDocument(int $id);

    public function getPolicyResource(string $identifier,array $params = []);
}
