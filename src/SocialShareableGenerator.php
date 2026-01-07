<?php

declare(strict_types=1);

namespace Escuelait\SocialShareable;

use Illuminate\Support\Str;

class SocialShareableGenerator
{
    public function __construct(
        protected string $url,
        protected string $title,
    ) {
    }

    public static function for(string $url, string $title): static
    {
        return new static($url, $title);
    }

    public function x(array $params = []): string
    {
        $query = http_build_query(array_merge([
            'url' => $this->url,
            'text' => Str::limit($this->title, 120),
        ], $params));

        return "https://x.com/intent/tweet?{$query}";
    }

    public function facebook(array $params = []): string
    {
        $queryParams = array_merge([
            'u' => $this->url,
            'quote' => $this->title,
        ], $params);

        $appId = config('social-shareable.facebook_app_id');
        if ($appId) {
            $queryParams['app_id'] = $appId;
        }

        $query = http_build_query($queryParams);

        return "https://www.facebook.com/sharer/sharer.php?{$query}";
    }

    public function whatsapp(array $params = []): string
    {
        $message = "{$this->title} {$this->url}";

        $queryParams = array_merge([
            'text' => $message,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://wa.me/?{$query}";
    }

    public function linkedin(array $params = []): string
    {
        $queryParams = array_merge([
            'url' => $this->url,
            'title' => $this->title,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://www.linkedin.com/sharing/share-offsite/?{$query}";
    }

    public function pinterest(array $params = []): string
    {
        $queryParams = array_merge([
            'url' => $this->url,
            'description' => $this->title,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://pinterest.com/pin/create/button/?{$query}";
    }

    public function telegram(array $params = []): string
    {
        $queryParams = array_merge([
            'url' => $this->url,
            'text' => $this->title,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://t.me/share/url?{$query}";
    }

    public function email(array $params = []): string
    {
        $queryParams = array_merge([
            'subject' => $this->title,
            'body' => $this->url,
        ], $params);

        $query = http_build_query($queryParams);

        return "mailto:?{$query}";
    }

    public function reddit(array $params = []): string
    {
        $queryParams = array_merge([
            'url' => $this->url,
            'title' => $this->title,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://reddit.com/submit?{$query}";
    }

    public function bluesky(array $params = []): string
    {
        $message = "{$this->title} {$this->url}";

        $queryParams = array_merge([
            'text' => $message,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://bsky.app/intent/compose?{$query}";
    }

    public function mastodon(array $params = []): string
    {
        $message = "{$this->title} {$this->url}";

        $queryParams = array_merge([
            'text' => $message,
        ], $params);

        $query = http_build_query($queryParams);

        return "https://mastodon.social/share?{$query}";
    }
}
