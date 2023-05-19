<?php

namespace Jetstream\Curacel\Package\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IPolicyService;

class PolicyService extends CuracelApiConfig implements IPolicyService
{

    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/policies';
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAllPolicies(array $params = []): array
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPolicyDocument(int $id): array
    {
        return $this->get("{$this->path}/{$id}/doc");
    }

    /**
     * @param string $identifier
     * @param array $params
     * @return array
     */
    public function getPolicyResource(string $identifier, array $params = []): array
    {
        return $this->get("{$this->path}/{$identifier}",$params);
    }
}
