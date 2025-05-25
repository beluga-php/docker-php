<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ImagePush as BaseEndpoint;
use Docker\Stream\PushStream;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ImagePush extends BaseEndpoint
{
    public function getUri(): string
    {
        return str_replace(['{name}'], [urlencode($this->name)], '/images/{name}/push');
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $response->getStatusCode()) {
            return new PushStream($response->getBody(), $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
