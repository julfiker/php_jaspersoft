<?php

namespace Julfiker\Jasper\Manager;

use Jaspersoft\Client\Client;

/**
 * JasperSoft publisher report generate
 *
 * Class JasperReport
 * @package Julfiker\Jesper\Manager
 */
class  JasperReport
{
    protected $serverUrl;
    protected $username;
    protected $password;

    private $path;
    private $params;
    private $type;
    private $client;

    /**
     * Generate report based on property set
     *
     * @return mixed
     * @throws \Exception
     */
    public function generate() {
        try {

            $parameters = $this->getParams();

            if (!$this->getPath())
                throw new \Exception('Report path not set!');
            if (!$this->getType())
                throw new \Exception('Report type not set!');

            return $this->client->reportService()->runReport($this->getPath(), $this->getType(), null, null, $parameters);

        }
        catch (\Exception $e) {
            echo $e->getMessage();
            throw new \Exception("Something went wrong, Please try again by refresh the page");
        }
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return JasperReport
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     * @return OraclePublisher
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Add parameter
     *
     * @param $param
     * @return $this
     */
    public function addParam($param) {
        $this->params[] = $param;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return OraclePublisher
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param mixed $username
     * @return JasperReport
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param mixed $password
     * @return JasperReport
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $serverUrl
     * @return JasperReport
     */
    public function setServerUrl($serverUrl)
    {
        $this->serverUrl = $serverUrl;
        return $this;
    }

    /**
     * Make a client object
     * @throws \Exception
     */
    public function make() {

        if (!$this->serverUrl || !$this->username || !$this->password)
            throw new \Exception("Jasper not configured yet.");

        $this->client = new Client(
            $this->serverUrl,
            $this->username,
            $this->password
        );

        return $this;
    }

    /**
     * Set request timeout for curl request to get report binary from jasper server
     *
     * @param $seconds
     * @return $this
     */
    public function setRequestTimeout($seconds) {
        $this->client->setRequestTimeout($seconds);

        return $this;
    }
}
