<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\SystemEvents as BaseEndpoint;
use Docker\Stream\EventStream;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SystemEvents extends BaseEndpoint
{
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $response->getStatusCode()) {
            return new EventStream($response->getBody(), $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
