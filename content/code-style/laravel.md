# Laravel Style Guide

- [About Laravel](#about-laravel)
- [General PHP Rules](#general-php-rules)
- [Configuration](#configuration)
- [Routing](#routing)
- [Controllers](#controllers)
- [Views](#views)
- [Validation](#validation)
- [Blade Templates](#blade-templates)
- [Authorization](#authorization)
- [Comments](#comments)

## About Laravel

First and foremost, Laravel provides the most value when you write things the way Laravel intended you to write. If there's a documented way to achieve something, follow it. Whenever you do something differently, make sure you have a justification for *why* you didn't follow the defaults.

## General PHP Rules

Code style must follow [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/). Generally speaking, everything string-like that's not public-facing should use camelCase. Detailed examples on these are spread throughout the guide in their relevant sections.

## Configuration

Configuration files must use kebab-case.

```
config/
  pdf-generator.php
```

Configuration keys must use snake_case.

```php
// config/pdf-generator.php
return [
    'chrome_path' => env('CHROME_PATH'),
];
```

Avoid using the `env` helper outside of configuration files. Create a configuration value from the `env` variable like above.

## Routing

Public-facing urls must use kebab-case.

```
https://spatie.be/open-source
https://spatie.be/jobs/front-end-developer
```

Route names must use camelCase.

```php
Route::get('open-source', 'OpenSourceController@index')->name('openSource');
```

```html
<a href="{{ route('openSource') }}">
    Open Source
</a>
```

## Controllers

Controllers that control a resource must use the plural resource name.

```php
class PostsController
{
    // ...
}
```

Try to keep controllers simple and stick to the default CRUD keywords (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`). Extract a new controller if you need other actions.

In the following example, we could have `PostsController@favorite`, and `PostsController@unfavorite`, or we could extract it to a seperate `FavoritePostsController`.

```php
class PostsController
{
    public function create()
    {
        // ...
    }
    
    // ...
    
    public function favorite(Post $post)
    {
        request()->user()->favorites()->attach($post);
        
        return response(null, 200);
    }

    public function unfavorite()
    {
        request()->user()->favorites()->detach($post);
        
        return response(null, 200);
    }
}
```

Here we fall back to default CRUD words, `create` and `destroy`.

```php
class FavoritePostsController
{
    public function create(Post $post)
    {
        request()->user()->favorites()->attach($post);
        
        return response(null, 200);
    }

    public function destroy()
    {
        request()->user()->favorites()->detach($post);
        
        return response(null, 200);
    }
}
```

This is a loose guideline that doesn't need to be enforced.

## Views

View files must use camelCase.

```
resources/
  views/
    openSource.blade.php
```

```php
class OpenSourceController
{
    public function index() {
        return view('openSource');
    }
}
```

## Validation

All custom validation rules must use snake_case:

```php
Validator::extend('organisation_type', function ($attribute, $value) {
    return OrganisationType::isValid($value);
});
```

## Blade Templates

Indent using four spaces.

```html
<a href="/open-source">
    Open Source
</a>
```

Don't add spaces after control structures.

```html
@if($condition)
    Something
@endif
```

## Authorization

Policies must use camelCase.

```php
Gate::define('editPost', function ($user, $post) {
    return $user->id == $post->user_id;
});
```

```html
@can('editPost', $post)
    <a href="{{ route('posts.edit', $post) }}">
        Edit
    </a>
@endcan
```

Try to name abilities using default CRUD words. One exception: replace `show` with `view`. A server shows a resource, a user views it.

## Comments

Comments should be avoided as much as possible by writing expressive code. If you do need to use a comment format it like this:

```php
// There should be space before a single line comment.

/*
 * If you need to explain a lot you can use a comment block. Notice the
 * single * on the first line. Comment blocks don't need to be three
 * lines long or three characters shorter than the previous line.
 */
```
