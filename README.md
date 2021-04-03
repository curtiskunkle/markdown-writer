# Markdown Writer

![PHP](https://img.shields.io/packagist/php-v/ckunkle/markdownwriter)
![Tag](https://img.shields.io/github/v/tag/curtiskunkle/markdown-writer)
![License](https://img.shields.io/github/license/curtiskunkle/markdown-writer)

### Description
A library for generating markdown using PHP. This library provides a class for building markdown following the [CommonMark](https://commonmark.org) specification and providing support for some common extensions including:
- Superscripts
- Subscripts
- Tables
- Strikethrough (Using `~~syntax~~`)

### Intallation

```bash
composer require ckunkle/markdownwriter
```

# API

##### Intantiate a markdown writer

```php
<?php

require_once("path/to/vendor/autoload.php")

$md = new \MarkdownWriter\Writer();
```

## Inline Methods

Methods that transform input to return a formatted markdown string

### italic

Format italic string

```php
$md->italic("test");
```

```markdown
*test*
```

### bold

Format bold string

```php
$md->bold("test");
```

```markdown
**test**
```

### superscript

Format superscript

```php
$md->superscript("test");
```

```markdown
^test^
```

### subscript

Format subscript

```php
$md->subscript("test");
```

```markdown
~test~
```

### code

Format inline code

```php
$md->code("test");
```

```markdown
`test`
```

### strikethrough

Format strikethrough

```php
$md->strikethrough("test");
```

```markdown
~~test~~
```

### link

Format an inline link

```php
$md->link("test", "http://example.com");
```

```markdown
[test](http://example.com)
```

### image

Format an inline image

```php
$md->image("test", "path/to/file.png");
```

```markdown
![test](path/to/file.png)
```

## Block Methods

Methods that write a block to the markdown string

### write



### newLine



### nl



### h1



### h2



### h3



### h4



### h5



### h6



### p



### hr



### block



### ul



### ol



### ulItem



### olItem



### blockQuote



### codeBlock



### table



## Configuration/Misc

All other methods

### setEOL



### eol



### __toString