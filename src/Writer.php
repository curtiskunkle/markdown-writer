<?php

namespace MarkdownWriter;

class Writer {

	const LIST_TYPE_OL = "ol";
	const LIST_TYPE_UL = "ul";	
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
	 * Create an inline superscript
	 * @return string
	 */
	public function superscript($string) {
		return "^$string^";
	}

	/**
	 * Create an inline subscript
	 * @return string
	 */
	public function subscript($string) {
		return "~$string~";
	}

	/**
	 * Create an inline code
	 * @return string
	 */
	public function code($string) {
		return "`$string`";
	}

	/**
	 * Create an inline strikethrough
	 * @return string
	 */
	public function strikethrough($string) {
		return "~~$string~~";
	}
	
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
	 * Get the EOL char
	 * @return string
	 */
	public function eol() {
		return $this->eol;
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
		$this->addNewlineIfMarkdownNotEmpty();
		return $this->write($string)->nl();
	}

	/**
	 * Adds a newline if not the first element
	 */
	protected function addNewlineIfMarkdownNotEmpty() {
		if (!empty($this->markdown)) {
			$this->nl();
		}
	}

	/**
	 * Get the markdown string
	 * @return string
	 */
	public function markdown() {
		return rtrim($this->markdown, $this->eol);
	}

	/**
	 * Write an unordered list
	 * @param  array   $listItems
	 * @param  boolean $loose
	 * @return $this
	 */
	public function ul(array $listItems, $loose = false) {
		$this->addNewlineIfMarkdownNotEmpty();
		$this->writeList($listItems, static::LIST_TYPE_UL, $loose);
		if (!$loose) {
			$this->nl();
		}
		return $this;
	}

	/**
	 * Write an ordered list
	 * @param  array   $listItems
	 * @param  boolean $loose
	 * @return $this
	 */
	public function ol(array $listItems, $loose = false) {
		$this->addNewlineIfMarkdownNotEmpty();
		$this->writeList($listItems, static::LIST_TYPE_OL, $loose);
		if (!$loose) {
			$this->nl();
		}
		return $this;
	}

	/**
	 * Write an ordered or unordered list
	 * Supports nested lists in the form of arrays
	 * Ex
	 * [
	 * 		"item1",
	 * 		"item2",
	 * 		[
	 * 			"nestedItem1",
	 * 			"nestedItem2",
	 * 			"etc..."
	 * 		]
	 * ]
	 * @param  array   $listItems array of list items
	 * @param  string  $type      one of the list type constants
	 * @param  boolean $loose     is this a loose list - meaning blank lines between items
	 * @param  integer $numTabs   the number of tabs to indent items in this list
	 * @return $this
	 */
	protected function writeList(array $listItems, $type, $loose = false, $numTabs = 0) {
		if (!in_array($type, [static::LIST_TYPE_UL, static::LIST_TYPE_OL])) {
			throw new \InvalidArgumentException("Invalid list type provided");
		}
		if (empty($listItems)) {
			return $this;
		}
		$olNumber = 1;
		foreach ($listItems as $item) {
			if (is_array($item)) {
				$this->writeList($item, $type, $loose, ($numTabs + 1));
			} else {
				if ($type === static::LIST_TYPE_UL) {
					$this->ulItem($item, $numTabs);
				} else {
					$this->olItem($item, $numTabs, $olNumber);
					$olNumber++;
				}
				if ($loose) {
					$this->nl();
				}
			}
		}
		return $this;
	}

	/**
	 * Write an unordered list item applying the provided number of tabs
	 * @param  string  $string 
	 * @param  integer $numTabs
	 * @return $this
	 */
	public function ulItem($string, $numTabs = 0) {
		return $this->write($this->applyTabsToListItem("- $string", $numTabs))->nl();
	}

	/**
	 * Write an ordered list item applying the provided number of tabs
	 * @param  string  $string 
	 * @param  string  $listItemNumber
	 * @param  integer $numTabs
	 * @return $this
	 */
	public function olItem($string, $numTabs = 0, $listItemNumber = "1") {
		$listItemNumber = (string)$listItemNumber;
		return $this->write($this->applyTabsToListItem("$listItemNumber. $string", $numTabs))->nl();
	}

	/**
	 * Apply the provided number of tabs to the list item string
	 * @param  string  $string  
	 * @param  integer $numTabs 
	 * @return string
	 */
	protected function applyTabsToListItem($string, $numTabs = 0) {
		$string = (string)$string;
		if ($numTabs) {
			$spaces = "";
			for ($i = 0; $i < $numTabs; $i++) {
				$spaces .= "    ";
			}
			return $spaces . $string;
		}
		return $string;
	}

	/**
	 * Write a blockquote
	 *
	 * This accepts 3 different argument types for readability/flexibility
	 * 
	 * 1. string - just converts to block quote
	 * 2. array - creates a multi line string by imploding on the EOL char, then converts
	 * 2. callable - creates an instance of Writer and passes it to the callback, 
	 *               then converts the generated markdown from the created writer
	 *               
	 * @param  mixed $arg
	 * @return $this
	 */
	public function blockQuote($arg) {
		$string = "";
		if (is_callable($arg)) {
			$md = new self();
			$arg($md);
			$string = $md->__toString();
		} elseif (is_array($arg)) {
			$string = implode($this->eol, array_map(function($item) {
				return (string)$item;
			}, $arg));
		} else {
			$string = (string)$arg;
		}
		
		$converted = $this->convertStringToBlockquote($string);
		return $this->block($converted);
	}

	/**
	 * Converts a string to a blockquote by 
	 * 1. exploding on the EOL char
	 * 2. prepending > to each line
	 * 3. imploding on the EOL char
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function convertStringToBlockquote($string) {
		$parts = explode($this->eol, $string);
		$parts = array_map(function($item) {
			$item = (string)$item;
			return "> $item"; 
		}, $parts);
		return implode($this->eol, $parts);
	}

	/**
	 * Write a "fenced" code block
	 * 
	 * @param  mixed $arg  string or array representing the code to render
	 * @param  string $lang optional language arg for flavors that support syntax highlighting
	 * @return $this
	 */
	public function codeBlock($arg, $lang = "") {
		if (is_array($arg)) {
			$string = implode($this->eol, array_map(function($item) {
				return (string)$item;
			}, $arg));
		} else {
			$string = (string)$arg;
		}

		$text = "```";
		if ($lang) {
			$text .= (string)$lang;
		}
		$text .= $this->eol;
		$text .= $string;
		$text .= $this->eol;
		$text .= "```";
		return $this->block($text);
	}

	/**
	 * Writes a table
	 *
	 * Expects an array of arrays where the first array is the table columns
	 * and the remaining arrays are the table rows
	 *
	 * Ex
	 * [
	 * 		["header1", "header2"],
	 * 		["val1", "val2"],
	 * 		["etc", "..."],
	 * ]
	 * 
	 * @param  array  $table
	 * @return $this
	 */
	public function table(array $table) {
		//validate
		if (empty($table)) return $this;
		foreach ($table as $row) {
			if (!is_array($row)) {
				throw new \InvalidArgumentException("Argument passed to table must be array of arrays");
			}
		}

		$table = array_values($table);

		//format
		$cellLength = 3; //min
		foreach ($table as $key => $row) {
			foreach ($row as $subKey => $str) {
				$table[$key][$subKey] = (string)$str;
				if (strlen($table[$key][$subKey]) > $cellLength) {
					$cellLength = strlen($table[$key][$subKey]);
				}
			}
		}

		//header
		$tableStr = "|" . implode("|", array_map(function($item) use ($cellLength) {
			return str_pad($item, $cellLength);
		}, $table[0])) . "|" . $this->eol;
		$tableStr .= "|";
		for ($i = 0; $i < count($table[0]); $i++) {
			$tableStr .= str_pad("", $cellLength, "-") . "|";
		}
		$tableStr .= $this->eol;

		foreach ($table as $key => $row) {
			if ($key === 0) continue;
			$tableStr .= "|" . implode("|", array_map(function($item) use ($cellLength) {
				return str_pad($item, $cellLength);
			}, $row)) . "|";
			if ($key !== count($table) - 1) {
				$tableStr .= $this->eol;
			}
		}

		return $this->block($tableStr);
	}

	/**
	 * Get the markdown string
	 * @return string
	 */
	public function __toString() {
		return $this->markdown();
	}
}