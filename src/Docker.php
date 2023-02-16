<?php

declare(strict_types=1);

namespace Docker;

use Docker\API\Client;
use Docker\API\Model\AuthConfig;
use Docker\API\Model\ExecIdStartPostBody;
use Docker\Endpoint\ContainerAttach;
use Docker\Endpoint\ContainerAttachWebsocket;
use Docker\Endpoint\ContainerLogs;
use Docker\Endpoint\ExecStart;
use Docker\Endpoint\ImageBuild;
use Docker\Endpoint\ImageCreate;
use Docker\Endpoint\ImagePush;
use Docker\Endpoint\SystemEvents;

/**
 * Docker\Docker.
 */
class Docker extends Client
{
    /**
     * {@inheritdoc}
     */
    public function containerAttach(string $id, array $queryParameters = [], string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new ContainerAttach($id, $queryParameters, $accept), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function containerAttachWebsocket(string $id, array $queryParameters = [], string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new ContainerAttachWebsocket($id, $queryParameters, $accept), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function containerLogs(string $id, array $queryParameters = [], string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        return $this->executeEndpoint(new ContainerLogs($id, $queryParameters, $accept), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function execStart(string $id, ?ExecIdStartPostBody $execStartConfig = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new ExecStart($id, $execStartConfig), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function imageBuild($inputStream = null, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new ImageBuild($inputStream, $queryParameters, $headerParameters), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function imageCreate(?string $inputImage = null, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new ImageCreate($inputImage, $queryParameters, $headerParameters), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function imagePush(string $name, array $queryParameters = [], array $headerParameters = [], string $fetch = self::FETCH_OBJECT, array $accept = [])
    {
        if (isset($headerParameters['X-Registry-Auth']) && $headerParameters['X-Registry-Auth'] instanceof AuthConfig) {
            $headerParameters['X-Registry-Auth'] = \base64_encode($this->serializer->serialize($headerParameters['X-Registry-Auth'], 'json'));
        }

        return $this->executeEndpoint(new ImagePush($name, $queryParameters, $headerParameters, $accept), $fetch);
    }

    /**
     * {@inheritdoc}
     */
    public function systemEvents(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new SystemEvents($queryParameters), $fetch);
    }

    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = DockerClientFactory::createFromEnv();
        }

        return parent::create($httpClient, $additionalPlugins, $additionalNormalizers);
    }
}
