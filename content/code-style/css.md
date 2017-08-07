# CSS Style Guide

We currently use SCSS, but principles are useable for other pre/postprocessors.

- [HTML](#html)
- [CSS classes](#css-classes)
- [SCSS syntax](#scss-syntax)
- [File structure](#file-structure)
- [Tools](#tools)
- [Inspiration](#inspiration)

## HTML 

- All styling is done by classes
- Make elements easily reusable, moveable in a project, or between projects
- Avoid #id's for styling
- Avoid multiple components on 1 DOM-element

```html
<!-- Try to avoid --> 
<div class="grid__col -half news">
    ...
</div>    

<!-- More flexible, readable & moveable -->
<div class="grid__col -half">
    <article class="news">
    ... 
    </article>
</div>   
```

Block tags are interchangeable since styling is done by class:
```html
<!-- All the same -->
<div class="article">
<section class="article">
<article class="article">
```

Html tags that are out of control (eg. the output of an editor) are scoped by the parent:
```html
<div class="article has-html">
    <!-- custom html output -->
</div>    
```



## CSS classes

We follow a BEVM syntax with custom accents.

```scss
.js-hook                     // Script hook, not used for styling

.block                       // Parent block   
.block__element              // Child block
.block__element__element     // Grandchild 

                             // Shorthand if possible
.items                       // Parent block
.item                        // Child block

.block--variation            // Standalone variation of a block
.block__element--variation   // Standalone variation of an element
.v-block                     // Block only used in specific view

.-modifier                   // Single property modifier

.h-type-value                // Generic helper grouped by type (eg. `h-align`, `h-margin`)
.is-state                    // State change by server or client
.has-something               // Parent class nests styling for children (eg. text editor output)

```

Class order in the DOM:

```html
<div class="js-hook block__element -modifier h-helper is-state has-something">
```

Visual class grouping can be done with `... | ...`:

```html
<div class="js-masonry | news__item -blue -small | h-hidden is-active has-html">
```

### .js-hook

```html
<div class="js-map ..."
     data-map-icon="url.png"
     data-map-lat="4.56"
     data-map-lon="1.23">
```

- Use `js-hook` to initiate handlers like `document.getElementsByClassName('js-hook')`
- Use `data-attributes` only for data storage or configuration storage
- Has no effect on styling whatsoever

### .blocks and .block__elements

`class="news"`

- Defined in `components/*.scss`, `patterns/*.scss` or `views/*.scss`
- A single reusable component, patterns or view specific block 
- Children are separated with `__`
- All lowercase, can contain `-` in name

```html
class="news"
class="news__item"
class="news__item__publish-date"
```     

- Use descriptive language. Consider `class="team__member"` instead of `class="team__item"`:

```html
class="team"
class="team__member"
```   

- You can use plurals & singulars for readability. Consider `class="person"` instead of `class="persons_person"`:

```html
class="persons"
class="person"
```   

### .block--variation

`class="button--delete"`

```scss
.button--delete {
    @extend .button;
    
    background-color: red; 
    color: white;
    text-transform: uppercase;
}
```

- Defined in `components/*.scss` or `patterns/*.scss`
- A variation adds a few properties to a block, and acts as a shorthand for multiple modifiers
- It's used stand-alone without the need to use the base class `button`
- It's a logical case to use `@extend` here, so the variation can inherit the original modifiers


### .v-block

```html
class="v-auth"
class="v-auth__form"
```

- Defined in `views/*.scss`
- A special component that is not reusable, but tied to a specific view
- Mostly exceptions and one-time styling
- Use sparsely, try to think in more generic components



### .-modifier

`class="button -rounded"`

```scss
.button {
    &.-rounded {
      ...
    }
```

- Defined in `components/*.scss` or `patterns/*.scss`
- A modifier changes one basic properties of a block, or adds a property
- Modifiers are **always tied** to a component or block, don't work on their own
- Make it generic and reusable if possible: `class="team -large"` is better than `class="team -management"`
- Multiple modifiers are possible. Each modifier is responsible for a property: `class="alert -success -rounded -large"`
- The order in html or css should therefore not matter


### .h-type-value

`class="h-align-right"`

```html
class="h-align-right"
class="h-visibility-hidden"
class="h-text-ellipsis"
```

- Eg. defined in `helpers/*.scss`
- Reusable properties throughout the entire project
- Prefixed by type (= the property that will be effected)
- Each helper class is responsible for a well-defined set of properties


### .is-state

`class="is-loaded"`

```scss
&.is-loaded {
    ...
}
```

- Special kind of modifier
- Classes added by server or client
- For state indication, interaction, animation start/stop 


### .has-something

`class="article has-html"`

```scss
&.has-html {
    h1 {
      ...
    }
}
```

- Explicit scoping class indicates special status of this DOM node's tree
- An exception to the rule "all is class" when content of the node is rendered by a external component
- Styling is done by nesting in the namespace




## Scss syntax 
 
```scss

/* Comment */

.block {                             // Indent 4 spaces, space before bracket                                   
    
    @include ...;                   //  @includes first
         
    a-property: value;              // Props sorted automatically by csscomb
    b-property: value; 
    c-property: .45em;              // No leading zero's
    
    &:hover {                       // Pseudo class
      ...
    }
    
    &:before,                       // Pseudo-elements
    &:after {                       // Each on a line
      ...
    }
    
    &.-modifier {
      ...                           // Limit props or create variation
    }
     
    &.-modifier2 {
      ...                        
    }
    
    
    /* Try to avoid */
    
    @extend ...;                   // Use only for variations. See eg. https://www.sitepoint.com/avoid-sass-extend/
    
    &_subclass {                   // Unreadable and not searchable
    
    }
                
    h1 {                           // Avoid unless you cannot add a class to the H1 element
      ...
    }
          
}
                                   // Line between blocks;
.block--variation {                // A block with few extra modifications often used together
    @extend .block;                // Only good use for @extend 
    ...
}
    
.block__element {                  // Separate class for readability, searchability
    ...
}


```


## File structure

We typically use 8 folders and a main `app.scss` file:

```
|-- base            : basic html elements
|-- components      : single components
|-- helpers         : helper classes
|-- patterns        : more complex components with parent/child relations
|-- settings        : variables
|-- utility         
|  |-- functions    : SCSS functions
|  `-- mixins       : SCSS mixins
|-- vendor          : custom files from 3rd party components like fancybox, select2 etc.
|-- views           : non-reusable components specific for a view
`-- app.scss        : main file

```


### App.scss

- Source order shouldn't matter, except for order of folders: import npm libraries, settings and utilities first
- Import is done by glob pattern so files can be moved easily from eg. components to patterns
 
```scss
@import 'settings/**/*';
@import '~normalize-css/normalize';
@import 'utility/**/*';
@import 'base/**/*';
@import 'components/**/*';
@import 'patterns/**/*';
@import 'helpers/**/*';
@import 'vendor/**/*';
@import 'views/**/*'; 
```

### Base folder

Contains sensible defaults for basic html elements. Example files and classes:

```
|-- *.scss
|-- html.scss
|-- a.scss
|-- p.scss
|-- h.scss
`--...

```

Example file `*.scss`:

```scss
* {
    box-sizing: border-box;
    position: relative;

    &:after,
    &:before {
        box-sizing: border-box;
    }
}
```


### Components folder

Stand-alone reusable components with modifiers and variations.

```
|-- alert.scss
|-- avatar.scss
`-- ...

```

Excerpt from `alert.scss`:

```scss
.alert {
    
    ...

    &.-small {
        ...
    }
}

.alert--success {
    @extend .alert;
    ...
}

```


### Helpers folder

Stand-alone helper classes for small layout issues.

```
|-- align.scss
|-- margin.scss
|-- padding.scss
`-- ...

```

Excerpt from `margin.scss`:

```scss
.h-margin {
    ...
}

.h-margin-none {
    ...
}

.h-margin-small {
    ...
}

.h-margin-medium {
    ...
}
```


### Patterns folder

More complex reusable patterns with parent/child relations, modifiers and variations.

```
|-- footer.scss
|-- grid.scss
`-- ...

```

Excerpt from `grid.scss`:

```scss
.grid {
    ...
}

.grid__col {

    &.-width-1\/2 {
        ...
    }

    &.-width-1\/3 {
        ...
    }

    &.-width-2\/3 {
        ...
    }
}
```

### Settings folder

Settings for colors, breakpoints, typography. etc.

```
|-- breakpoint.scss
|-- color.scss
|-- grid.scss
`-- ...

```

Excerpt from `color.scss`:

```scss
$blue: (
    lightest: #e6f5ff,
    lighter: #8bcdff,
    light: #2cb0de,
    default: #0080c8,
    dark: #047ac5,
    darker: #024271,
    darkest: #00284f,
);
```


### Utility folder

SCSS common mixins and functions.

```
|-- functions
|   |--color.scss
|   |--sass-map.scss
|   `--...
`-- mixins
    |--background.scss
    |--block.scss
    `--...

```

Excerpt from `functions/color.scss`:

```scss
@function blue($key: default, $opacity: 1) {
    ...
}

@function green($key: default, $opacity: 1) {
    ...
}

@function gray($key: default, $opacity: 1) {
    ...
}
```

Excerpt from `mixins/block.scss`:

```scss
@mixin block-reset {
    ...
}

@mixin block-cover($position: absolute) {
    ...
}

@mixin block-tag($color, $background-color) {
    ...
}

@mixin block-clearfix {
    ...
}
```

### Vendor folder

Imported and customized SCSS from 3rd party components (this is the syntactical Wild West).

```
|-- fancybox.scss
|-- select2.scss
`-- ...

```

### View folder

Non-reusable CSS rules tied to specific views. Consider this the exception, and try to keep this folder empty. 

```
|-- auth.scss
|-- home.scss
`-- ...

```

Excerpt from `auth.scss`:

```scss
.v-auth{
    ...
}

.v-auth__gravatar{
    ...
}
```

## Tools

### Spatie-scss

[@spatie/scss](https://github.com/spatie/scss) is a small npm package that is used to kickstart CSS authoring with default settings, mixins, functions etc.
It lacks the `vendor` and `view` folders, since these are specific to every project.

### Code Style
- Install cscomb globally via `npm i csscomb -g` 
- Put a `.csscomb.json` in root dir of your project
- Run `csscomb resources`

## Inspiration

- [CSS Wizardry](https://csswizardry.com) 
- [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/) 
