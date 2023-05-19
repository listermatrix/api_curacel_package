<?php

namespace Jetstream\Curacel\Package\Interface;

interface IPolicyService
{
    public function getAllPolicies(array $params = []);

    public function getPolicyDocument(int $id);

    public function getPolicyResource(string $identifier,array $params = []);
}
