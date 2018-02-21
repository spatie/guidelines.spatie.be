<?php

namespace App;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class CustomCsp extends Basic
{

    public function configure()
    {
        parent::configure();

        $this
            ->addDirective(Directive::BASE, 'self')
            ->addDirective(Directive::STYLE, ['https://cloud.typography.com', 'https://spatie.be'])
            ->addDirective(Directive::FONT, 'data:')
            ->addDirective(Directive::SCRIPT, 'data:')
            ->addDirective(Directive::CHILD, 'https://www.googletagmanager.com')
            ->addDirective(Directive::FRAME, 'https://www.googletagmanager.com')
            ->addDirective(Directive::WORKER, 'https://www.googletagmanager.com')
            ->addDirective(Directive::SCRIPT, 'strict-dynamic')
            ->addDirective(Directive::SCRIPT, 'unsafe-inline')
            ->reportOnly();
    }
}