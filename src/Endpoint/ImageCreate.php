<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ImageCreate as BaseEndpoint;
use Docker\Stream\CreateImageStream;
use Nyholm\Psr7\Stream;
use Symfony\Component\Serializer\SerializerInterface;
use \Psr\Http\Message\ResponseInterface;

class ImageCreate extends BaseEndpoint
{
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = NULL)    {
        if (200 === $response->getStatusCode()) {
            $stream = Stream::create($response->getBody());
            $stream->rewind();

            return new CreateImageStream($stream, $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
