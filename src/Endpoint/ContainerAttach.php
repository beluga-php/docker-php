<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ContainerAttach as BaseEndpoint;
use Docker\Stream\DockerRawStream;
use Nyholm\Psr7\Stream;
use Symfony\Component\Serializer\SerializerInterface;
use \Psr\Http\Message\ResponseInterface;

class ContainerAttach extends BaseEndpoint
{
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = NULL)    {
        if (200 === $response->getStatusCode() && DockerRawStream::HEADER === $contentType) {
            $stream = Stream::create($response->getBody());
            $stream->rewind();

            return new DockerRawStream($stream);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
