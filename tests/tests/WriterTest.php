<?php 

class WriterTest extends \PHPUnit\Framework\TestCase {

    public function testItalic() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->italic("test");
        $this->assertEquals($result, "*test*");
    }

    public function testBold() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->bold("test");
        $this->assertEquals($result, "**test**");
    }

    public function testSuperscript() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->superscript("test");
        $this->assertEquals($result, "^test^");
    }

    public function testSubscript() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->subscript("test");
        $this->assertEquals($result, "~test~");
    }

    public function testCode() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->code("test");
        $this->assertEquals($result, "`test`");
    }

    public function testStrikethrough() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->strikethrough("test");
        $this->assertEquals($result, "~~test~~");
    }

    public function testLink() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->link("My Link", "http://example.com");
        $this->assertEquals($result, "[My Link](http://example.com)");
    }

    public function testImage() {
        $md = new \MarkdownWriter\Writer();
        $result = $md->image("My Image", "http://example.com");
        $this->assertEquals($result, "![My Image](http://example.com)");
    }

    public function testSetEOL() {
        $md = new \MarkdownWriter\Writer();
        $md->setEOL("test");
        $this->assertEquals($md->eol(), "test");
    }

    public function testWrite() {
        $md = new \MarkdownWriter\Writer();
        $md->write("test");
        $this->assertEquals($md->__toString(), "test");
    }

    public function testNewLine() {
        $md = new \MarkdownWriter\Writer();
        $md->nl();
        $md->write("test");
        $this->assertEquals($md->__toString(), $md->eol() . "test");

        $md = new \MarkdownWriter\Writer();
        $md->nl(2);
        $md->write("test");
        $this->assertEquals($md->__toString(), $md->eol() . $md->eol() . "test");
    }

    public function testHeadings() {
        $md = new \MarkdownWriter\Writer();
        $md
        ->h1("heading")
        ->h2("heading")
        ->h3("heading")
        ->h4("heading")
        ->h5("heading")
        ->h6("heading");
        $this->assertEquals($md->__toString(), 
            "# heading" . $md->eol() . $md->eol() . 
            "## heading" . $md->eol() . $md->eol() . 
            "### heading" . $md->eol() . $md->eol() . 
            "#### heading" . $md->eol() . $md->eol() . 
            "##### heading" . $md->eol() . $md->eol() . 
            "###### heading"
        );
    }

    public function testParagraph() {
        $md = new \MarkdownWriter\Writer();
        $md
        ->p("paragraph 1")
        ->p("paragraph 2");
        $this->assertEquals($md->__toString(), 
            "paragraph 1" . $md->eol() . $md->eol() . 
            "paragraph 2"
        );
    }

    public function testHorizontalRule() {
        $md = new \MarkdownWriter\Writer();
        $md->hr()->hr();
        $this->assertEquals($md->__toString(), 
            "---" . $md->eol() . $md->eol() . 
            "---"
        );
    }

    public function testBlockSpacing() {
        $md = new \MarkdownWriter\Writer();
        $md->block("thing 1")->block("thing 2");
        $this->assertEquals($md->__toString(), 
            "thing 1" . $md->eol() . $md->eol() . 
            "thing 2"
        );
    }

    public function testWritingListItems() {
        $md = new \MarkdownWriter\Writer();
        $md
        ->ulItem("item")
        ->ulItem("item", 1)
        ->ulItem("item", 2)
        ->olItem("item")
        ->olItem("item", 1, "12")
        ->olItem("item", 2, "3");

        $this->assertEquals($md->__toString(), 
            "- item" . $md->eol() .
            "    - item" . $md->eol() .
            "        - item" . $md->eol() .
            "1. item" . $md->eol() .
            "    12. item" . $md->eol() .
            "        3. item"
        );
    }

    public function testUl() {
        $md = new \MarkdownWriter\Writer();
        $md->ul([
            "item 1",
            "item 2"
        ]);
        $this->assertEquals($md->__toString(), 
            "- item 1" . $md->eol() .
            "- item 2"
        );
    }

    public function testUlLoose() {
        $md = new \MarkdownWriter\Writer();
        $md->ul([
            "item 1",
            "item 2"
        ], true);
        $this->assertEquals($md->__toString(), 
            "- item 1" . $md->eol() . $md->eol() .
            "- item 2"
        );
    }

    public function testUlNested() {
        $md = new \MarkdownWriter\Writer();
        $md->ul([
            "item 1",
            "item 2",
            [
                "nest 1",
                "nest 2",
                [
                    "nest 3",
                    "nest 4"
                ]
            ]
        ]);
        $this->assertEquals($md->__toString(), 
            "- item 1" . $md->eol() .
            "- item 2" . $md->eol() .
            "    - nest 1" . $md->eol() .
            "    - nest 2" . $md->eol() .
            "        - nest 3" . $md->eol() .
            "        - nest 4"
        );
    }

    public function testUlNestedLoose() {
        $md = new \MarkdownWriter\Writer();
        $md->ul([
            "item 1",
            "item 2",
            [
                "nest 1",
                "nest 2",
                [
                    "nest 3",
                    "nest 4"
                ]
            ]
        ], true);
        $this->assertEquals($md->__toString(), 
            "- item 1" . $md->eol() . $md->eol() .
            "- item 2" . $md->eol() . $md->eol() .
            "    - nest 1" . $md->eol() . $md->eol() .
            "    - nest 2" . $md->eol() . $md->eol() .
            "        - nest 3" . $md->eol() . $md->eol() .
            "        - nest 4"
        );
    }

    public function testOl() {
        $md = new \MarkdownWriter\Writer();
        $md->ol([
            "item 1",
            "item 2"
        ]);
        $this->assertEquals($md->__toString(), 
            "1. item 1" . $md->eol() .
            "2. item 2"
        );
    }

    public function testOlLoose() {
        $md = new \MarkdownWriter\Writer();
        $md->ol([
            "item 1",
            "item 2"
        ], true);
        $this->assertEquals($md->__toString(), 
            "1. item 1" . $md->eol() . $md->eol() .
            "2. item 2"
        );
    }

    public function testOlNested() {
        $md = new \MarkdownWriter\Writer();
        $md->ol([
            "item 1",
            "item 2",
            [
                "nest 1",
                "nest 2",
                [
                    "nest 3",
                    "nest 4"
                ]
            ]
        ]);
        $this->assertEquals($md->__toString(), 
            "1. item 1" . $md->eol() .
            "2. item 2" . $md->eol() .
            "    1. nest 1" . $md->eol() .
            "    2. nest 2" . $md->eol() .
            "        1. nest 3" . $md->eol() .
            "        2. nest 4"
        );
    }

    public function testOlNestedLoose() {
        $md = new \MarkdownWriter\Writer();
        $md->ol([
            "item 1",
            "item 2",
            [
                "nest 1",
                "nest 2",
                [
                    "nest 3",
                    "nest 4"
                ]
            ]
        ], true);
        $this->assertEquals($md->__toString(), 
            "1. item 1" . $md->eol() . $md->eol() .
            "2. item 2" . $md->eol() . $md->eol() .
            "    1. nest 1" . $md->eol() . $md->eol() .
            "    2. nest 2" . $md->eol() . $md->eol() .
            "        1. nest 3" . $md->eol() . $md->eol() .
            "        2. nest 4"
        );
    }

    public function testBlockQuoteString() {

        $md = new \MarkdownWriter\Writer();

        $text = 
"This is some text for a block quote

It has multiple lines and some " . $md->bold("emphasis");

        $md->blockQuote($text);
        $this->assertEquals($md->__toString(), 
"> This is some text for a block quote
> 
> It has multiple lines and some **emphasis**"
        );
    }

    public function testBlockQuoteArray() {

        $md = new \MarkdownWriter\Writer();

        $md->blockQuote([
            "This block quote uses an array argument",
            "",
            "but still gets the job done",
        ]);
        $this->assertEquals($md->__toString(), 
"> This block quote uses an array argument
> 
> but still gets the job done"
        );
    }

    public function testBlockQuoteClosure() {

        $md = new \MarkdownWriter\Writer();

        $md->blockQuote(function($md) {
            $md->p("This blockquote uses a callback")
            ->p("This allows us to use the writer's functionality to create content")
            ->blockQuote([
                "including",
                "blockQuotes"
            ]);
        })->h3("This enables us to write nested blockquotes");
        $this->assertEquals($md->__toString(), 
"> This blockquote uses a callback
> 
> This allows us to use the writer's functionality to create content
> 
> > including
> > blockQuotes

### This enables us to write nested blockquotes"
        );
    }

    public function testCodeBlockString() {
        $md = new \MarkdownWriter\Writer();

        $md->codeBlock("This is some code");
        $this->assertEquals($md->__toString(), 
            "```" . $md->eol() .
            "This is some code" . $md->eol() .
            "```"
        );
    }

    public function testCodeBlockStringWithLanguage() {
        $md = new \MarkdownWriter\Writer();

        $md->codeBlock("This is some code", "php");
        $this->assertEquals($md->__toString(), 
            "```php" . $md->eol() .
            "This is some code" . $md->eol() .
            "```"
        );
    }

    public function testCodeBlockArray() {
        $md = new \MarkdownWriter\Writer();

        $md->codeBlock([
            "this is some code",
            "",
            "but this uses an array to write the block"
        ]);
        $this->assertEquals($md->__toString(), 
            "```" . $md->eol() .
            "this is some code" . $md->eol() . $md->eol() .
            "but this uses an array to write the block" . $md->eol() .
            "```"
        );
    }

    public function testCodeBlockArrayWithLanguage() {
        $md = new \MarkdownWriter\Writer();

        $md->codeBlock([
            "this is some code",
            "",
            "but this uses an array to write the block"
        ], "php");
        $this->assertEquals($md->__toString(), 
            "```php" . $md->eol() .
            "this is some code" . $md->eol() . $md->eol() .
            "but this uses an array to write the block" . $md->eol() .
            "```"
        );
    }

    public function testTable() {
        $md = new \MarkdownWriter\Writer();
        $md->table([
            ["c1", "c2", "c3"]
        ]);
        $this->assertEquals($md->__toString(), 
            "|c1 |c2 |c3 |" . $md->eol() .
            "|---|---|---|"
        );

        $md = new \MarkdownWriter\Writer();
        $md->table([
            ["c1", "column2", "c3"]
        ]);
        $this->assertEquals($md->__toString(), 
            "|c1     |column2|c3     |" . $md->eol() .
            "|-------|-------|-------|"
        );

        $md = new \MarkdownWriter\Writer();
        $md->table([
            ["c1", "column2", "c3"],
            ["val1", "val2", "val3"],
        ]);
        $this->assertEquals($md->__toString(), 
            "|c1     |column2|c3     |" . $md->eol() .
            "|-------|-------|-------|" . $md->eol() . 
            "|val1   |val2   |val3   |"
        );
    }

    public function testFullExample() {
        $md = new \MarkdownWriter\Writer();
        $md
        ->h1("Full Example")
        ->p("This is a paragraph")
        ->p("This is a paragraph too")
        ->p(
            $md->bold("bold") . " " .
            $md->italic("italic") . " " .
            $md->superscript("superscript") . " " .
            $md->subscript("subscript") . " " .
            $md->code("code") . " " .
            $md->strikethrough("strikethrough") . " " .
            $md->link("My Link", "a/path") . " " .
            $md->image("My Image", "another/path")
        )
        ->write("just appending some text")
        ->hr()
        ->block("This is some text in a block")
        ->ul([
            "item1",
            "item2",
            [
                "nested1",
                "nested2",
            ],
        ])
        ->ol([
            "item1",
            "item2",
            [
                "nested1",
                "nested2",
            ],
        ])
        ->blockQuote([
            "here is a  ",
            "blockquote",
        ])
        ->codeBlock([
            "here is a code block"
        ], "php")
        ->table([
            ["col1", "col2", "col3"],
            ["val1", "val2", "val3"],
            ["val1", "val2", "val3"],
            ["val1", "val2", "val3"],
        ]);
        print_r((string)$md);die;
        $this->assertEquals($md->__toString(), 
            "# Full Example" . $md->eol() . $md->eol() .
            "This is a paragraph" . $md->eol() . $md->eol() .
            "This is a paragraph too" . $md->eol() . $md->eol() .
            "**bold** *italic* ^superscript^ ~subscript~ `code` ~~strikethrough~~ [My Link](a/path) ![My Image](another/path)" . $md->eol() . 
            "just appending some text" . $md->eol() .
            "---" . $md->eol() . $md->eol() .
            "This is some text in a block" . $md->eol() . $md->eol() .
            "- item1" . $md->eol() .
            "- item2" . $md->eol() .
            "    - nested1" . $md->eol() .
            "    - nested2" . $md->eol() . $md->eol() . 
            "1. item1" . $md->eol() .
            "2. item2" . $md->eol() .
            "    1. nested1" . $md->eol() .
            "    2. nested2" . $md->eol() . $md->eol() .
            "> here is a  " . $md->eol() .
            "> blockquote" . $md->eol() . $md->eol() .
            "```php" . $md->eol() .
            "here is a code block" . $md->eol() .
            "```" . $md->eol() . $md->eol() .
            "|col1|col2|col3|" . $md->eol() .
            "|----|----|----|" . $md->eol() .
            "|val1|val2|val3|" . $md->eol() .
            "|val1|val2|val3|" . $md->eol() .
            "|val1|val2|val3|"
        );
    }
}