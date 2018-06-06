<?php

namespace App\Markdown;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Spatie\Sheets\ContentParsers\MarkdownWithFrontMatterParser;

class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MarkdownWithFrontMatterParser::class)
            ->needs(CommonMarkConverter::class)
            ->give(function () {
                $environment = Environment::createCommonMarkEnvironment();
                $environment->addBlockRenderer(Heading::class, new HeadingRenderer());

                return new CommonMarkConverter([], $environment);
            });
    }
}
