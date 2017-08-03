<?php

namespace App\Navigation;

use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Menu;
use Symfony\Component\Yaml\Yaml;

class Navigation
{
    /** @var \Illuminate\Support\Collection */
    private $sections;

    public function scanContent()
    {
        $yaml = new Yaml();

        $this->sections = collect([
            glob(base_path('content/private/**/navigation.yml')),
            glob(base_path('content/**/navigation.yml')),
        ])
            ->flatten()
            ->mapWithKeys(function ($path) use ($yaml) {
                $properties = $yaml->parse(file_get_contents($path));
                $title = $properties['title'] ?? null;
                $private = str_contains($path, '/content/private/');

                return [
                    dirname($path) => [
                        'title' => $title,
                        'weight' => $properties['weight'] ?? 0,
                        'items' => array_map(function ($item) use ($private, $title) {
                            $slug = $title ? str_slug($title).'/'.str_slug($item) : str_slug($item);
                            return [
                                'title' => $item,
                                'slug' => $slug,
                                'private' => $private,
                                'path' => $private ? "/private/{$slug}.md" : "{$slug}.md",
                                'edit_url' => "https://github.com/spatie/guidelines.spatie.be/edit/master/content/{$slug}.md",
                            ];
                        }, $properties['items']),
                        'private' => $private,
                    ],
                ];
            })
            ->sortBy('weight');

        return $this;
    }

    public function getPage($url)
    {
        $page = $this->pages()->where('slug', $url)->first();

        if (! $page) {
            return null;
        }

        if ($page['private'] && ! Auth::check()) {
            return null;
        }

        $contents = file_get_contents(
            base_path("content/{$page['path']}")
        );

        return (object) ($page + ['contents' => $contents]);
    }

    private function pages()
    {
        return $this->sections->pluck('items')->collapse();
    }

    public function menu()
    {
        $sections = $this->sections->reject(function ($section) {
            return $section['private'] && ! Auth::check();
        });

        $menu = Menu::build($sections, function ($menu, $section) {
            return $menu->submenu(
                ...$this->buildSectionSubmenu($section)
            );
        });

        return $menu
            ->addClass('menu')
            ->addItemParentClass('menu__section')
            ->setActiveClass('-active')
            ->setActiveFromRequest();
    }

    private function buildSectionSubmenu($section)
    {
        [$items, $title] = collect($section)->extract('items', 'title');

        $submenu = Menu::build($items, function ($menu, $item) use ($title) {
            $menu->link(url($item['slug']), $item['title']);
        });

        $submenu
            ->addClass('menu__submenu')
            ->addItemParentClass('menu__item js-sidebar-hide')
            ->setActiveClass('-active');

        if (empty($title)) {
            return [$submenu];
        }

        return ["<span class=menu__subtitle>{$title}</span>", $submenu];
    }
}
