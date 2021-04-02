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
}