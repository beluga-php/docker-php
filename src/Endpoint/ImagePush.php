<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ImagePush as BaseEndpoint;
use Docker\Stream\PushStream;
use Nyholm\Psr7\Stream;
use Symfony\Component\Serializer\SerializerInterface;
use \Psr\Http\Message\ResponseInterface;

class ImagePush extends BaseEndpoint
{
    public function getUri(): string
    {
        return \str_replace(['{name}'], [\urlencode($this->name)], '/images/{name}/push');
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = NULL)    {
        if (200 === $response->getStatusCode()) {
            $stream = Stream::create($response->getBody());
            $stream->rewind();

            return new PushStream($stream, $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
