<?php

namespace Escuelait\SocialShareable;

use Escuelait\SocialShareable\SocialShareableGenerator;

trait SocialShareable
{
    /**
     * Generates URL for share
     *
     * @param  string  $type   Social network name (x, facebook, whatsapp...).
     * @param  array   $params Extra params to query string.
     */
    public function getShareUrl(string $type, array $params = []): string
    {
        $generator = SocialShareableGenerator::for(
            $this->resolveShareUrl(),
            $this->resolveShareTitle(),
        );

        if (!method_exists($generator, $type)) {
            throw new \InvalidArgumentException("Share type [{$type}] is not supported.");
        }

        return $generator->{$type}($params);
    }

    protected function resolveShareUrl(): string
    {
        return $this->url ?? url()->current() ?? '';
    }

    protected function resolveShareTitle(): string
    {
        return $this->title ?? '';
    }
}
