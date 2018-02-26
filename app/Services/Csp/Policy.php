<?php

namespace App\Services\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Policy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this
            ->fonts()
            ->googleAnalytics()
            ->reportOnly();
    }

    protected function googleAnalytics(): self
    {
        return $this
            ->addDirective(Directive::CHILD, 'https://www.googletagmanager.com')
            ->addDirective(Directive::FRAME, 'https://www.googletagmanager.com')
            ->addDirective(Directive::WORKER, 'https://www.googletagmanager.com')
            ->addDirective(Directive::CONNECT, 'https://www.google-analytics.com')
            ->addDirective(Directive::SCRIPT, 'https://www.google-analytics.com')
            ->addDirective(Directive::SCRIPT, 'https://www.googletagmanager.com')
            ->addDirective(Directive::SCRIPT, 'strict-dynamic')
            ->addDirective(Directive::SCRIPT, 'unsafe-inline');
    }

    protected function fonts(): self
    {
        return $this
            ->addDirective(Directive::STYLE, ['https://cloud.typography.com', 'https://spatie.be'])
            ->addDirective(Directive::FONT, 'data:');
    }
}
