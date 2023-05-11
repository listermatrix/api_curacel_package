<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IPolicyService;

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
     * @return mixed
     * @throws RequestException
     */
    public function getAllPolicies(array $params = []): mixed
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RequestException
     */
    public function getPolicyDocument(int $id): mixed
    {
        return $this->get("{$this->path}/{$id}/doc");
    }

    /**
     * @param string $identifier
     * @param array $params
     * @return array|mixed
     * @throws RequestException
     */
    public function getPolicyResource(string $identifier, array $params = []): mixed
    {
        return $this->get("{$this->path}/{$identifier}",$params);
    }
}
