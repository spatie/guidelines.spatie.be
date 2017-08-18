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
.component                      /* Component */   
.component__element             /* Child */
.component__element__element    /* Grandchild */

.items                          /* Use plurals if possible */
.item                        

.-modifier                      /* Single property modifier, can be chained */

.component--variation           /* Standalone variation of a component */
.component__element--variation  /* Standalone variation of an element */

.helper-property                /* Generic helper grouped by type (eg. `align-right`, `margin-top-s`) */

.js-hook                        /* Script hook, not used for styling */
```

### .component and .component__element

```html
<div class="news">
```

- A single reusable component or pattern
- Children are separated with `__`
- All lowercase, can contain `-` in name
- Avoid more than 3 levels deep

```html
<div class="news">
    <div class="news__item">
        <div class="news__item__publish-date">
```     

Be descriptive with component elements. Consider `class="team__member"` instead of `class="team__item"`

```html
<div class="team">
    <div class="team__member">
```   

You can use plurals & singulars for readability. Consider `class="member"` instead of `class="members__member"`

```html
<div class="members">
    <div class="member">
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

- A modifier changes only simple properties of a component, or adds a property
- Modifiers are **always tied** to a component, don't work on their own (make sure you never write "global" modifier selectors)
- Multiple modifiers are possible. Each modifier is responsible for a property: `class="alert -success -rounded -large"`. If you keep using these modifiers together, consider a **variation** (see below)
- Since modifiers have a single responsability, the order in HTML or CSS shouldn't matter

### .component--variation

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

- A variation adds more than one properties at once to a class, and acts as a shorthand for multiple modifiers often used together
- It's used stand-alone without the need to use the base class `button`
- It's a logical case to use `@apply` here, so the variation can inherit the original modifiers (**under consideration**)
- Even variations should be generic and reusable if possible: `class="team--large"` is better than `class="team--management"`

### .helper-property

```html
<div class="align-right">
<div class="visibility-hidden">
<div class="text-ellipsis">
<div class="margin-top-s">
```

- Reusable utility classes throughout the entire project
- Prefixed by type (= the property that will be effected)
- Each helper class is responsible for a well-defined set of properties. It should be clear that these are not components

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
<div class="grid__col -1/2 news">
    …
</div>    

<!-- More flexible, readable & moveable -->
<div class="grid__col -1/2">
    <article class="news">
        …
    </article>
</div>   
```

Tags are interchangeable since styling is done by class.

```html
<!-- All the same -->
<div class="article">
<section class="article">
<article class="article">
```

Html tags that are out of control (eg. the output of an editor) are scoped by the component.

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
<div class="js-hook component__element -modifier helper">
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

.component {                      /* Indent 4 spaces, space before bracket */                                   
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
                
    h1 {                          /* Avoid unless you have no control over the HTML inside the `.component` */
        …
    }
          
}
                                  /* Line between classes */
.component--variation {           /* A component with few extra modifications often used together */
    @apply .component;            /* Only good use for @apply */
    …
}
    
.component__element {             /* Separate class for readability, searchability instead of `&__element`*/
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
- Import is done by glob pattern so files can be added easily
 
```css
@import 'settings/**/*';
@import 'base/**/*';
@import 'components/**/*';
@import 'helpers/**/*';
@import 'vendor/**/*';
```

### Base folder

Contains resets and sensible defaults for basic html elements. 

```
|-- universal.css
|-- html.css
|-- a.css
|-- p.css
|-- heading.css (h1, h2, h3)
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

Settings for colors, breakpoints, typography, etc. You can start small with one `settings.css` and split them up in different files if your variables grow.

```
|-- breakpoint.css
|-- color.css
|-- grid.css
`-- …
```

### Vendor folder

Imported and customized CSS from 3rd party components (this is the syntactical Wild West, you probably don't want to lint this).

```
|-- pikaday.css
|-- select2.css
`-- …
```

## Inspiration

- [CSS Wizardry](https://csswizardry.com) 
- [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/) 
