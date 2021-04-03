# Markdown Writer

![PHP](https://img.shields.io/packagist/php-v/ckunkle/markdownwriter)
![Tag](https://img.shields.io/github/v/tag/curtiskunkle/markdown-writer)
![License](https://img.shields.io/github/license/curtiskunkle/markdown-writer)

### Description
A library for generating markdown using PHP. This library provides a class for building markdown following the [CommonMark](https://commonmark.org) specification. It also provides support for some common extensions including:
- Superscripts
- Subscripts
- Tables
- Strikethrough (Using `~~syntax~~`)

### Intallation

```bash
composer require ckunkle/markdownwriter
```

### Example Usage

```php
<?php
require_once("vendor/autoload.php");

$md = new \MarkdownWriter\Writer();
$md->h1("Example Markdown")
->p("This class makes generating markdown using PHP quick and convenient")
->ol([
    "Here is",
    "An ordered list",
    "With",
    [
        "Nested",
        [
            "Sublists"
        ],
    ],
])
->blockQuote("View the API documentation below to learn more features");
```

```markdown
# Example Markdown

This class makes generating markdown using PHP quick and convenient

1. Here is
2. An ordered list
3. With
    1. Nested
        1. Sublists

> View the API documentation below to learn more features
```

For a more elaborate example, view [the script](gendocs.php) that generated this README file.

# API

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

Methods that write to the markdown result

### write

Append string to the markdown result

```php
$md->write("A string of text");
$md->write(" Another string of text");
echo($md);
```

```markdown
A string of text Another string of text
```

### block

Write an EOL string if the markdown result is not empty, write the provided string, then write another EOL string. This keeps blank lines between consecutive block elements.

```php
$md->block("A string of text");
$md->block("Another string of text");
echo($md);
```

```markdown
A string of text

Another string of text
```

### p

Writes a paragraph to the markdown result making sure that there are blank lines before and after.

```php
$md->p("A string of text");
$md->p("Another string of text");
echo($md);
```

```markdown
A string of text

Another string of text
```

### nl

Appends an EOL string to the markdown result

```php
$md->write("A string of text");
$md->nl();
$md->nl();
$md->write("Another string of text");
echo($md);
```

```markdown
A string of text

Another string of text
```

```php
//or pass an integer for multiple newlines
$md->write("A string of text");
$md->nl(2);
$md->write("Another string of text");
echo($md);
```

```markdown
A string of text

Another string of text
```

### h1

Write a header 1

```php
$md->h1("Header");
echo($md);
```

```markdown
# Header
```

### h2

Write a header 2

```php
$md->h2("Header");
echo($md);
```

```markdown
## Header
```

### h3

Write a header 3

```php
$md->h3("Header");
echo($md);
```

```markdown
### Header
```

### h4

Write a header 4

```php
$md->h4("Header");
echo($md);
```

```markdown
#### Header
```

### h5

Write a header 5

```php
$md->h5("Header");
echo($md);
```

```markdown
##### Header
```

### h6

Write a header 6

```php
$md->h6("Header");
echo($md);
```

```markdown
###### Header
```

### hr

Write a horizontal rule

```php
$md->write("A string");
$md->hr();
$md->write("Another string");
echo($md);
```

```markdown
A string
---
Another string
```

### ulItem

Write an unordered list item. Optionally provide the number of tabs to prepend to it

```php
$md->ulItem("Item1");
$md->ulItem("Item2", 1);
$md->ulItem("Item3", 2);
echo($md);
```

```markdown
- Item1
    - Item2
        - Item3
```

### olItem

Write an ordered list item. Optionally provide the number of tabs to prepend to it and the string to prepend it with (defaults to 1)

```php
$md->olItem("Item1");
$md->olItem("Item2", 1);
$md->olItem("Item3", 2, "123");
echo($md);
```

```markdown
1. Item1
    1. Item2
        123. Item3
```

### ul

Write an unordered list. Use nested arrays to indicate nesting sublists.

```php
$md->ul([
    "Item1",
    "Item2",
    "Item3",
    [
        "Subitems",
        [
            "SubSubItems..."
        ],
    ],
]);
echo($md);
```

```markdown
- Item1
- Item2
- Item3
    - Subitems
        - SubSubItems...
```

### ol

Write an ordered list. Use nested arrays to indicate nesting sublists.

```php
$md->ol([
    "Item1",
    "Item2",
    "Item3",
    [
        "Subitems",
        [
            "SubSubItems..."
        ],
    ],
]);
echo($md);
```

```markdown
1. Item1
2. Item2
3. Item3
    1. Subitems
        1. SubSubItems...
```

### blockQuote

Write a blockquote. This supports a few different syntaxes:

```php
$md->blockQuote("Pass a string for simple block quote...");
$md->blockQuote([
    "Or an array for",
    "a multiline block quote",
]);
$md->blockQuote(function($md) {
    $md->p("This blockquote uses a callback")
    ->p("This allows us to use the writer's functionality to create content")
    ->blockQuote([
        "including",
        "block quotes"
    ]);
});
```

```markdown
> Pass a string for a simple block quote...

> Or an array for
> a multiline block quote

> This blockquote uses a callback
> 
> This allows us to use the writer's functionality to create content
> 
> > including
> > block quotes
```

### codeBlock

Write a "fenced" code block. Accepts a string or array of lines. Optionally pass a language for syntax highlighting as the second parameter.

```php
$md->codeBlock("echo('This is a code block');");
```

```markdown
    ```php
    echo('This is a code block');
    ```
```

### table

Write a table. This expects an array of arrays where the first array is the header row, and the following arrays represent table rows.

```php
$md->table([
    ["col1", "col2", "col3"],
    ["val1", "val2", "val3"],
    ["val1", "val2", "val3"],
]);
```

```markdown
|col1|col2|col3|
|----|----|----|
|val1|val2|val3|
|val1|val2|val3|
```

## Configuration/Misc

All other methods

### setEOL

Set the EOL string. By default this is set to `PHP_EOL`

### eol

Get the EOL string

### __toString

Returns the markdown result string