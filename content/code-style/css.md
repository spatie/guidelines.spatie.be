# CSS Style Guide

- [Preprocessing](#preprosessing)
- [BEVM](#bevm)
- [DOM structure](#dom-structure)
- [Code style](#code-style)
- [File structure](#file-structure)
- [Inspiration](#inspiration)

## Preprocessing

We use PostCSS with [CSSNext](http://cssnext.io), but these principles are applicable to any pre- or postprocessors out there.

## BEVM

We use a BEM-like syntax with some custom accents. The 'variation' is a concept picked up from [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/). 

We only use classes for styling, with the following ingredients:

```css
.block                       /* Parent block */   
.block__element              /* Child block */
.block__element__element     /* Grandchild */

                             /* Shorthand if possible */
.items                       /* Parent block */
.item                        /* Child block */

.-modifier                   /* Single property modifier, can be chained */

.block--variation            /* Standalone variation of a block */
.block__element--variation   /* Standalone variation of an element */

.helper-property             /* Generic helper grouped by type (eg. `align-right`, `margin-top-s`) */

.js-hook                     /* Script hook, not used for styling */
```

### .blocks and .block__elements

```html
<div class="news">
```

- A single reusable component or pattern
- Children are separated with `__`
- All lowercase, can contain `-` in name

```html
<div class="news">
    <div class="news__item">
        <div class="news__item__publish-date">
```     

Be descriptive with block elements. Consider `class="team__member"` instead of `class="team__item"`

```html
<div class="team">
    <div class="team__member">
```   

You can use plurals & singulars for readability. Consider `class="person"` instead of `class="people_person"`

```html
<div class="people">
    <div class="person">
```   

### .-modifier

```html
<div class="button -rounded -active">
```

```css
.button {
    &.-rounded {
        …  
    }

    &.-active {
        …
    }
}
```

- A modifier changes one basic properties of a block, or adds a property
- Modifiers are **always tied** to a component or block, don't work on their own (make sure you never write "global" modifier selectors)
- Modifiers should be generic and reusable if possible: `class="team -large"` is better than `class="team -management"`
- Multiple modifiers are possible. Each modifier is responsible for a property: `class="alert -success -rounded -large"`. If you keep using these modifiers together, consider a **variation** (see below)
- Since modifiers have a single responsibility, the order in html or css shouldn't matter

### .block--variation

```html
<div class="button--delete">
```

```css
.button--delete {
    /* Base button classes */
    …
    
    /* Variations */
    background-color: red; 
    color: white;
    text-transform: uppercase;
}
```

- A variation adds more than one properties at once to a class, and acts as a shorthand for multiple modifiers
- It's used stand-alone without the need to use the base class `button`
- It's a logical case to use `@apply` here, so the variation can inherit the original modifiers (**under consideration**)

### .helper-property

```html
<div class="helper-right">
```

```html
<div class="align-right">
<div class="visibility-hidden">
<div class="text-ellipsis">
<div class="margin-top-s">
```

- Reusable properties throughout the entire project
- Prefixed by type (= the property that will be effected)
- Each helper class is responsible for a well-defined set of properties

### .js-hook

```html
<div class="js-map …"
     data-map-icon="url.png"
     data-map-lat="4.56"
     data-map-lon="1.23">
```

- Use `js-hook` to initiate handlers like `document.getElementsByClassName('js-hook')`
- Use `data-attributes` only for data storage or configuration storage
- Has no effect on styling whatsoever

## DOM structure 

- All styling is done by classes (except for HTML that is out of our control)
- Avoid #id's for styling
- Make elements easily reusable, moveable in a project, or between projects
- Avoid multiple components on 1 DOM-element, break them up

```html
<!-- Try to avoid, news padding or margin could break the grid--> 
<div class="grid__col -half news">
    …
</div>    

<!-- More flexible, readable & moveable -->
<div class="grid__col -half">
    <article class="news">
        …
    </article>
</div>   
```

Block tags are interchangeable since styling is done by class.

```html
<!-- All the same -->
<div class="article">
<section class="article">
<article class="article">
```

Html tags that are out of control (eg. the output of an editor) are scoped by the parent.

```html
<div class="article">
    <!-- custom html output -->
</div>    
```

```css
.article {
    /* Tag instead of class here */
    & h2 {
        …
    }

    & p {
        …
    }    
}
```

### Class order

```html
<div class="js-hook block__element -modifier helper">
```

Visual class grouping can be done with `… | …`:

```html
<div class="js-masonry | news__item -blue -small -active | padding-top-s align-right">
```

## Code style

We use [stylelint](https://github.com/stylelint/stylelint) to lint our stylesheets. 
Configuration is done a custom `.stylelintrc` which extends `stylelint-config-standard`.

```
{
  "extends": "stylelint-config-standard",
  "ignoreFiles": "resources/assets/css/vendor/*",
  "rules": {
      "indentation": [4],
      "at-rule-empty-line-before": null,
      "number-leading-zero": null,
      "selector-pseudo-element-colon-notation": "single",
    }
}
```

### Installation

```
yarn add stylelint
yarn add stylelint-config-standard
```

### Usage

Most projects have a lint script (with the `--fix` flag) available in their `package.json`.

```
stylelint resources/assets/css/**/**.css --fix -r
```

### Examples
 
```css
/* Comment */

.block {                          /* Indent 4 spaces, space before bracket */                                   
    @at-rule …;                   /*  @at-rules first */
         
    a-property: value;            /* Props sorted automatically by eg. PostCSS-sorting */
    b-property: value; 
    c-property: .45em;            /* No leading zero's */
    
    &:hover {                     /* Pseudo class */
        …
    }
    
    &:before,                     /* Pseudo-elements */
    &:after {                     /* Each on a line */
        …
    }
    
    &.-modifier {
        …                           
    }
     
    &.-modifier2 {
        …                        
    }
    
    /* Try to avoid */
    
    @apply …;                     /* Use only for variations */
    
    &_subclass {                  /* Unreadable and not searchable */
        …
    }
                
    h1 {                          /* Avoid unless you have no control over the HTML inside the `.block` */
        …
    }
          
}
                                  /* Line between blocks */
.block--variation {               /* A block with few extra modifications often used together */
    @apply .block;                /* Only good use for @apply */
    …
}
    
.block__element {                 /* Separate class for readability, searchability instead of `&__element`*/
    …
}

```

## File structure

We typically use 5 folders and a main `app.css` file:

```
|-- base       : basic html elements
|-- components : single components
|-- helpers    : helper classes
|-- settings   : variables
|-- vendor     : custom files from 3rd party components like fancybox, select2 etc.
`-- app.css    : main file
```


### app.css

- We use `postcss-easy-import` for glob imports
- Source order shouldn't matter, except for order of folders: import npm libraries, settings or utilities first
- Import is done by glob pattern so files can be moved easily from eg. components to patterns
 
```css
@import 'settings/**/*';
@import 'base/**/*';
@import 'components/**/*';
@import 'helpers/**/*';
@import 'vendor/**/*';
```

### Base folder

Contains resets and sensible defaults for basic html elements. Example files and classes:

```
|-- universal.css
|-- html.css
|-- a.css
|-- p.css
|-- hx.css (h1, h2, h3)
|-- list.css (ul, ol, dl)
`-- …
```

### Components folder

Stand-alone reusable components with their modifiers and variations.

```
|-- alert.css
|-- avatar.css
`-- …
```

### Helpers folder

Stand-alone helper classes for small layout issues.

```
|-- align.css
|-- margin.css
|-- padding.css
`-- …
```

### Settings folder

Settings for colors, breakpoints, typography. etc.

```
|-- breakpoint.css
|-- color.css
|-- grid.css
`-- …
```

### Vendor folder

Imported and customized CSS from 3rd party components (this is the syntactical Wild West).

```
|-- fancybox.css
|-- select2.css
`-- …
```

## Inspiration

- [CSS Wizardry](https://csswizardry.com) 
- [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/) 
