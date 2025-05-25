<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ImageCreate as BaseEndpoint;
use Docker\Stream\CreateImageStream;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ImageCreate extends BaseEndpoint
{
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $response->getStatusCode()) {
            return new CreateImageStream($response->getBody(), $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
