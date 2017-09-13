# Laravel Style Guide

- [About Laravel](#about-laravel)
- [Code style](#code-style)
- [Composer Rules](#composer-rules)
- [Folder structure](#folder-structure)
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

## Code style

Code style must follow [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/). Generally speaking, everything string-like that's not public-facing should use camelCase. Detailed examples on these are spread throughout the guide in their relevant sections.

We have extended the PSR-2 rulesets and exported the settings in order
to make sure that everyone is formatting code in the same way.

Download <a href="/code_style/Laravel_PSR2_Adaptive.xml" target="_blank">this file</a>
and go to `PHPStorm -> Preferences -> Editor -> Code Style` and press the
cog wheel and press `Import scheme -> IntelliJ IDEA code style XML`

When working in legacy code bases, try to avoid re-formatting a complete file
in your PRs. This makes it very difficult to properly review the PR.

### Making things breathe

Code needs room to breathe. 
We keep one empty line between methods and functions.

To make conditionals readable we infuse some air there, too.

Bad:
```
if(!isset($user)){$user=User::find(1);}
```

Good:
```
if (! isset($user)) {
    $user = User::find(1);
}
```

### PHPDoc
Docblocks are to be used where it makes sense and where it gives
substancial value that PHP 7.1-typehinting can not provide.

Bad:
``` 
/**
 * @var array
 */
protected $filterable = [
    [
        'column' => ['active'],
        'field' => 'active',
        'operator' => '='
    ],
];
```

Good:

```
protected $filterable = [
    [
        'column' => ['active'],
        'field' => 'active',
        'operator' => '=',
    ],
];
```

Bad:
```
<?php
/**
 * Created by PhpStorm.
 * User: viirre
 * Date: 2016-05-04
 * Time: 15:11
 */
```

Remove the above auto generated comment by PHPStorm:
> PHPStorm -> Preferences -> Editor -> File and Code Templates -> Includes-tab -> PHP File Header -> Empty this -> Press Apply 

### Facades vs helper methods
We prefer `app()` to `App::make()` and try to use the helper methods
where available.

### Use-statements
Bad:
```
<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Model {
    use Authenticatable;
    use CanResetPassword;
}
```

Good:
```
<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Model {
    use Authenticatable, CanResetPassword;
}
```

### Comments

Comments should be avoided as much as possible by writing expressive code. If you do need to use a comment format it like this:

```php
// There should be space before a single line comment.

// If you need to explain a lot you can use multiple comment lines.
// It's just pretty simple.
```

### Prefixes and Suffixes
<table class="table table-striped">
    <thead>
        <tr>
            <th>Type of file</th>
            <th>Prefix</th>
            <th>Suffix</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Interface</td>
            <td>No</td>
            <td title="To Be Discussed">TBD</td>
        </tr>
        <tr>
            <td>Contract</td>
            <td>No</td>
            <td title="To Be Discussed">TBD</td>
        </tr>
        <tr>
            <td>Trait</td>
            <td>No</td>
            <td>No*</td>
        </tr>
        <tr>
            <td>Exception</td>
            <td>No</td>
            <td><code>Exception</code></td>
        </tr>
        <tr>
            <td>Controller</td>
            <td>No</td>
            <td><code>
                    Controller
                </code>
            </td>
        </tr>
        <tr>
            <td>Transformer</td>
            <td>No</td>
            <td>
                <code>
                    Transformer
                </code>
            </td>
        </tr>
        <tr>
            <td>Middleware</td>
            <td>No</td>
            <td>No</td>
        </tr>
        <tr>
            <td>Notifications</td>
            <td>No</td>
            <td><code>Notification</code></td>
        </tr>
        <tr>
            <td>Event</td>
            <td>No</td>
            <td>No</td>
        </tr>
        <tr>
            <td>Listener</td>
            <td>No</td>
            <td>No</td>
        </tr>
        <tr>
            <td>Console command</td>
            <td>No</td>
            <td>No</td>
        </tr>
        <tr>
            <td>Policy</td>
            <td>No</td>
            <td><code>Policy</code></td>
        </tr>
        <tr>
            <td>Repository</td>
            <td>No</td>
            <td><code>Repository</code></td>
        </tr>
        <tr>
            <td>Middleware</td>
            <td>No</td>
            <td>No</td>
        </tr>
    </tbody>
</table>

\* A trait SHOULD BE suffixed with `Trait` when not in a folder
named Traits.

### Legacy
> "Always leave the campground cleaner than you found it." - The boyscout rule

Since we have older projects built when this guideline was not a thing,
it'll undoubtedly be cases where you stumble upon code that are 
not tolerated by this guideline.

Refactoring and fixing these issues are more than welcome.

## Composer Rules

We avoid running `composer update` on a project unless we're
upgrading the complete underlying Laravel-framework to a new
version. 

If you're in a need to update a specific composer package you're
free to do so by running `composer update laravelcollective/html`

If you need to re-generate the `composer.lock` file you can run
`composer update nothing` to do so safely.

## Folder structure
We try to follow the Laravel default folder structure where possible.
There are however cases where we've adopted the folder structure to the projects
needs. 

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

The `env` helper MUST NOT be used outside of configuration files. 
Create a configuration value from the `env` variable like above.

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

## Validation
Can be done in two ways:

### On the request object
```
request()->validate([
    'title' => 'required'
]);
```

### Request Form Validation
[See Laravel documentation](https://laravel.com/docs/5.5/validation#form-request-validation)


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

## Blade Templates

Indent using four spaces.

```html
<a href="/open-source">
    Open Source
</a>
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