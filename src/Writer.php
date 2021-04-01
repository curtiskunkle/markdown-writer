<?php

namespace MarkdownWriter;

class Writer {
	
	/**
	 * The markdown string
	 * @var string
	 */
	protected $markdown = "";

	/**
	 * End of line char
	 * @var string
	 */
	protected $eol = PHP_EOL;

	/**
	 * Wrap string in asterisks to italicize
	 * @param  string $string
	 * @return string
	 */
	public function italic($string) {
		return "*$string*";
	}

	/**
	 * Wrap string in asterisks to bolden
	 * @param  string $string
	 * @return string
	 */
	public function bold($string) {
		return "**$string**";
	}

	/**
	 * Create an inline link
	 * @param  string $string
	 * @return string
	 */
	
	/**
	 * Create an inline link
	 * @param  string $string
	 * @param  string $url   
	 * @return string
	 */
	public function link($string, $url) {
		return "[$string]($url)";
	}

	/**
	 * Create an inline image
	 * @param  string $alt
	 * @param  string $url   
	 * @return string
	 */
	public function image($alt, $url) {
		return "![$alt]($url)";
	}

	/**
	 * Append directly to the markdown result, will cast to string
	 * @param  string $string
	 * @return $this
	 */
	public function write($string) {
		$this->markdown .= (string)$string;
		return $this;
	}

	/**
	 * Set the EOL char
	 * @param string $string
	 * @return $this
	 */
	public function setEOL($string) {
		$this->eol = $string;
		return $this;
	}

	/**
	 * Append a newline char
	 * @return $this
	 */
	public function newLine($times = 1) {
		for ($i = 0; $i < $times; $i++) {
			$this->write($this->eol);
		}
		return $this;
	}

	/**
	 * Shorthand alias for newLine
	 * @return $this
	 */
	public function nl($times = 1) {
		return $this->newLine($times);
	}

	/**
	 * Write a heading 1
	 * @param  string $string
	 * @return $this
	 */
	public function h1($string) {
		return $this->writeHeading($string, 1);
	}

	/**
	 * Write a heading 2
	 * @param  string $string
	 * @return $this
	 */
	public function h2($string) {
		return $this->writeHeading($string, 2);
	}

	/**
	 * Write a heading 3
	 * @param  string $string
	 * @return $this
	 */
	public function h3($string) {
		return $this->writeHeading($string, 3);
	}

	/**
	 * Write a heading 4
	 * @param  string $string
	 * @return $this
	 */
	public function h4($string) {
		return $this->writeHeading($string, 4);
	}

	/**
	 * Write a heading 5
	 * @param  string $string
	 * @return $this
	 */
	public function h5($string) {
		return $this->writeHeading($string, 5);
	}

	/**
	 * Write a heading 6
	 * @param  string $string
	 * @return $this
	 */
	public function h6($string) {
		return $this->writeHeading($string, 6);
	}

	/**
	 * Write heading to markdown
	 * @param  string  $string
	 * @param  integer $level  
	 * @return $this
	 */
	protected function writeHeading($string, $level) {
		$hashes = "";
		for ($i = 0; $i < $level; $i++) {
			$hashes .= "#";
		}
		return $this->block("$hashes $string");
	}

	/**
	 * Write a paragraph
	 * this adds a newline before the text and two after
	 * @param  string $string 
	 * @return $this
	 */
	public function p($string) {
		return $this->block($string);
	}

	/**
	 * Add horizontal rule
	 * @return $this
	 */
	public function hr() {
		return $this->block("---");
	}

	/**
	 * Add a newline before writing the string if not the first element 
	 * then write the string
	 * then write two more new lines
	 * @param  string $string
	 * @return $this
	 */
	public function block($string) {
		if (!empty($this->markdown)) {
			$this->nl();
		}
		return $this->write($string)->nl(2);
	}

	public function markdown() {
		return $this->markdown;
	}

	public function __toString() {
		return $this->markdown();
	}
}