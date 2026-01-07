<?php

declare(strict_types=1);

namespace EscuelaIT\Test;

use Escuelait\SocialShareable\SocialShareableGenerator;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class SocialShareableGeneratorTest extends TestCase
{
    #[Test]
    public function can_create_instance_using_for_method(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);

        $this->assertInstanceOf(SocialShareableGenerator::class, $generator);
    }

    #[Test]
    public function can_generate_x_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $xUrl = $generator->x();

        $this->assertStringContainsString('https://x.com/intent/tweet?', $xUrl);
        $this->assertStringContainsString('url=' . urlencode($url), $xUrl);
        $this->assertStringContainsString('text=', $xUrl);
    }

    #[Test]
    public function title_is_limited_to_120_characters(): void
    {
        $url = 'https://escuela.it';
        $title = str_repeat('a', 200);

        $generator = SocialShareableGenerator::for($url, $title);
        $xUrl = $generator->x();

        $this->assertStringContainsString('text=' . urlencode(substr($title, 0, 120) . '...'), $xUrl);
    }

    #[Test]
    public function can_pass_custom_parameters_to_x(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $xUrl = $generator->x(['via' => 'escuelait']);

        $this->assertStringContainsString('via=escuelait', $xUrl);
    }

    #[Test]
    public function can_generate_facebook_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $facebookUrl = $generator->facebook();

        $this->assertStringContainsString('https://www.facebook.com/sharer/sharer.php?', $facebookUrl);
        $this->assertStringContainsString('u=' . urlencode($url), $facebookUrl);
        $this->assertStringContainsString('quote=', $facebookUrl);
    }

    #[Test]
    public function can_generate_whatsapp_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $whatsappUrl = $generator->whatsapp();

        $this->assertStringContainsString('https://wa.me/?', $whatsappUrl);
        $this->assertStringContainsString('text=', $whatsappUrl);
    }

    #[Test]
    public function can_generate_linkedin_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $linkedinUrl = $generator->linkedin();

        $this->assertStringContainsString('https://www.linkedin.com/sharing/share-offsite/?', $linkedinUrl);
        $this->assertStringContainsString('url=' . urlencode($url), $linkedinUrl);
        $this->assertStringContainsString('title=', $linkedinUrl);
    }

    #[Test]
    public function can_generate_pinterest_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $pinterestUrl = $generator->pinterest();

        $this->assertStringContainsString('https://pinterest.com/pin/create/button/?', $pinterestUrl);
        $this->assertStringContainsString('url=' . urlencode($url), $pinterestUrl);
        $this->assertStringContainsString('description=', $pinterestUrl);
    }

    #[Test]
    public function can_generate_telegram_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $telegramUrl = $generator->telegram();

        $this->assertStringContainsString('https://t.me/share/url?', $telegramUrl);
        $this->assertStringContainsString('url=' . urlencode($url), $telegramUrl);
        $this->assertStringContainsString('text=', $telegramUrl);
    }

    #[Test]
    public function can_generate_email_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $emailUrl = $generator->email();

        $this->assertStringContainsString('mailto:?', $emailUrl);
        $this->assertStringContainsString('subject=', $emailUrl);
        $this->assertStringContainsString('body=', $emailUrl);
    }

    #[Test]
    public function can_generate_reddit_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $redditUrl = $generator->reddit();

        $this->assertStringContainsString('https://reddit.com/submit?', $redditUrl);
        $this->assertStringContainsString('url=' . urlencode($url), $redditUrl);
        $this->assertStringContainsString('title=', $redditUrl);
    }

    #[Test]
    public function can_generate_bluesky_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $blueskyUrl = $generator->bluesky();

        $this->assertStringContainsString('https://bsky.app/intent/compose?', $blueskyUrl);
        $this->assertStringContainsString('text=', $blueskyUrl);
    }

    #[Test]
    public function can_generate_mastodon_share_url(): void
    {
        $url = 'https://escuela.it';
        $title = 'My Awesome Article';

        $generator = SocialShareableGenerator::for($url, $title);
        $mastodonUrl = $generator->mastodon();

        $this->assertStringContainsString('https://mastodon.social/share?', $mastodonUrl);
        $this->assertStringContainsString('text=', $mastodonUrl);
    }
}
