<?php

declare(strict_types=1);

namespace Docker\Endpoint;

use Docker\API\Endpoint\ImageBuild as BaseEndpoint;
use Docker\Stream\BuildStream;
use Docker\Stream\TarStream;
use Nyholm\Psr7\Stream;
use Symfony\Component\Serializer\SerializerInterface;
use \Psr\Http\Message\ResponseInterface;

class ImageBuild extends BaseEndpoint
{
    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        $body = $this->body;

        if (\is_resource($body)) {
            $body = new TarStream(Stream::create($body));
        }

        return [['Content-Type' => ['application/octet-stream']], $body];
    }

    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = NULL)    {
        if (200 === $response->getStatusCode()) {
            $stream = Stream::create($response->getBody());
            $stream->rewind();

            return new BuildStream($stream, $serializer);
        }

        return parent::transformResponseBody($response, $serializer, $contentType);
    }
}
