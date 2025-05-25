<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ExecStart as BaseEndpoint;
use Docker\Stream\DockerRawStream;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExecStart extends BaseEndpoint
{
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $response->getStatusCode() && DockerRawStream::HEADER === $contentType) {
            return new DockerRawStream($response->getBody());
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
