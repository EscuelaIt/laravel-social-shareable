<?php

namespace Escuelait\SocialShareable\Tests;

use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Escuelait\SocialShareable\SocialShareable;

class SocialShareableTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new class {
            use SocialShareable;
            public $url;
            public $title;
        };
    }

    #[Test]
    public function test_resolve_share_url_from_property()
    {
        $this->model->url = 'https://example.com';
        $result = $this->model->getShareUrl('facebook');

        $this->assertStringContainsString('facebook.com', $result);
        $this->assertStringContainsString('u=https%3A%2F%2Fexample.com', $result);
    }

    #[Test]
    public function test_resolve_share_title_from_property()
    {
        $this->model->url = 'https://example.com';
        $this->model->title = 'My Title';
        $result = $this->model->getShareUrl('facebook');

        $this->assertStringContainsString('facebook.com', $result);
        $this->assertStringContainsString('quote=My+Title', $result);
        $this->assertStringContainsString('u=https%3A%2F%2Fexample.com', $result);
    }

    #[Test]
    public function test_resolve_share_title_returns_empty_string_by_default()
    {
        $this->model->url = 'https://example.com';
        $result = $this->model->getShareUrl('facebook');

        $this->assertStringContainsString('facebook.com', $result);
        $this->assertStringContainsString('quote=', $result);
    }

    #[Test]
    public function test_get_share_url_with_valid_type()
    {
        $this->model->url = 'https://example.com';
        $this->model->title = 'Test';

        $result = $this->model->getShareUrl('facebook', ['extra' => 'param']);

        $this->assertStringContainsString('facebook.com', $result);
        $this->assertStringContainsString('extra=param', $result);
        $this->assertStringContainsString('u=https%3A%2F%2Fexample.com', $result);
    }

    #[Test]
    public function test_get_share_url_for_different_networks()
    {
        $this->model->url = 'https://example.com';
        $this->model->title = 'Check this out';

        // X (Twitter)
        $xUrl = $this->model->getShareUrl('x');
        $this->assertStringContainsString('x.com/intent/tweet', $xUrl);
        $this->assertStringContainsString('url=https%3A%2F%2Fexample.com', $xUrl);

        // WhatsApp
        $waUrl = $this->model->getShareUrl('whatsapp');
        $this->assertStringContainsString('wa.me', $waUrl);
        $this->assertStringContainsString('Check+this+out', $waUrl);

        // LinkedIn
        $linkedinUrl = $this->model->getShareUrl('linkedin');
        $this->assertStringContainsString('linkedin.com', $linkedinUrl);
        $this->assertStringContainsString('url=https%3A%2F%2Fexample.com', $linkedinUrl);
    }

    #[Test]
    public function test_get_share_url_throws_exception_for_invalid_type()
    {
        $this->model->url = 'https://example.com';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Share type [invalid_type] is not supported.');

        $this->model->getShareUrl('invalid_type');
    }
}
