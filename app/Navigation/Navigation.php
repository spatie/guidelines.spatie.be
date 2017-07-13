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

        $baseNavigation = base_path('content/navigation.yml');
        $sections = glob(base_path('content/**/navigation.yml'));

        $this->sections = collect($baseNavigation)
            ->merge($sections)
            ->mapWithKeys(function ($path) use ($yaml) {
                $properties = $yaml->parse(file_get_contents($path));
                $title = $properties['title'] ?? null;
                $private = $properties['private'] ?? null;

                return [
                    dirname($path) => [
                        'title' => $title,
                        'weight' => $properties['weight'] ?? 0,
                        'items' => array_map(function ($item) use ($private, $title) {
                            return [
                                'title' => $item,
                                'slug' => $title ? str_slug($title).'/'.str_slug($item) : str_slug($item),
                                'private' => $private,
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
            base_path("content/{$page['slug']}.md")
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
            ->addItemParentClass('menu__item')
            ->setActiveClass('-active');

        if (empty($title)) {
            return [$submenu];
        }

        return ["<span class=menu__subtitle>{$title}</span>", $submenu];
    }
}
