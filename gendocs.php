<?php
require_once("vendor/autoload.php");

$md = new \MarkdownWriter\Writer();
$md
->h1("Markdown Writer")
->p(
	$md->image("PHP", "https://img.shields.io/packagist/php-v/ckunkle/markdownwriter") . $md->eol() .
	$md->image("Tag", "https://img.shields.io/github/v/tag/curtiskunkle/markdown-writer") . $md->eol() .
	$md->image("License", "https://img.shields.io/github/license/curtiskunkle/markdown-writer")
)
->h3("Description")
->write("A library for generating markdown using PHP. This library provides a class for building markdown following the " . $md->link("CommonMark", "https://commonmark.org") . " specification. It also provides support for some common extensions including:")
->ul([
	"Superscripts",
	"Subscripts",
	"Tables",
	"Strikethrough (Using `~~syntax~~`)"
])
->h3("Intallation")
->codeBlock("composer require ckunkle/markdownwriter", "bash")
->h1("API")
->h5("Intantiate a markdown writer")
->codeBlock([
	"<?php",
	"",
	"require_once(\"path/to/vendor/autoload.php\")",
	"",
	"\$md = new \MarkdownWriter\Writer();"
], "php");

$map = [
	"Inline Methods" => [
		"description" => "Methods that transform input to return a formatted markdown string",
		"methods" => [
			"italic" => [
				"description" => "Format italic string",
				"examples" => [
					[
						"code" => "\$md->italic(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->italic("test")
					]
				],
			],
			"bold" => [
				"description" => "Format bold string",
				"examples" => [
					[
						"code" => "\$md->bold(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->bold("test")
					]
				],
			],
			"superscript" => [
				"description" => "Format superscript",
				"examples" => [
					[
						"code" => "\$md->superscript(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->superscript("test")
					]
				],
			],
			"subscript" => [
				"description" => "Format subscript",
				"examples" => [
					[
						"code" => "\$md->subscript(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->subscript("test")
					]
				],
			],
			"code" => [
				"description" => "Format inline code",
				"examples" => [
					[
						"code" => "\$md->code(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->code("test")
					]
				],
			],
			"strikethrough" => [
				"description" => "Format strikethrough",
				"examples" => [
					[
						"code" => "\$md->strikethrough(\"test\");",
						"result" => (string)(new \MarkdownWriter\Writer())->strikethrough("test")
					]
				],
			],
			"link" => [
				"description" => "Format an inline link",
				"examples" => [
					[
						"code" => "\$md->link(\"test\", \"http://example.com\");",
						"result" => (string)(new \MarkdownWriter\Writer())->link("test", "http://example.com")
					]
				],			],
			"image" => [
				"description" => "Format an inline image",
				"examples" => [
					[
						"code" => "\$md->image(\"test\", \"path/to/file.png\");",
						"result" => (string)(new \MarkdownWriter\Writer())->image("test", "path/to/file.png")
					]
				],
			],
		],
	],
	"Block Methods" => [
		"description" => "Methods that write to the markdown result",
		"methods" => [
			"write" => [
				"description" => "Append string to the markdown result",
				"examples" => [
					[
						"code" => [
							"\$md->write(\"A string of text\");",
							"\$md->write(\" Another string of text\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->write("A string of text")
							->write(" Another string of text")
					]
				],
			],
			"block" => [
				"description" => "Write an EOL string if the markdown result is not empty, write the provided string, then write another EOL string. This keeps blank lines between consecutive block elements.",
				"examples" => [
					[
						"code" => [
							"\$md->block(\"A string of text\");",
							"\$md->block(\"Another string of text\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->block("A string of text")
							->block("Another string of text")
					]
				],
			],
			"p" => [
				"description" => "Writes a paragraph to the markdown result making sure that there are blank lines before and after.",
				"examples" => [
					[
						"code" => [
							"\$md->p(\"A string of text\");",
							"\$md->p(\"Another string of text\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->p("A string of text")
							->p("Another string of text")
					]
				],
			],
			"nl" => [
				"description" => "Appends an EOL string to the markdown result",
				"examples" => [
					[
						"code" => [
							"\$md->write(\"A string of text\");",
							"\$md->nl();",
							"\$md->nl();",
							"\$md->write(\"Another string of text\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->write("A string of text")
							->nl()
							->nl()
							->write("Another string of text")
					],
					[
						"code" => [
							"//or pass an integer for multiple newlines",
							"\$md->write(\"A string of text\");",
							"\$md->nl(2);",
							"\$md->write(\"Another string of text\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->write("A string of text")
							->nl(2)
							->write("Another string of text")
					]
				],
			],
			"h1" => [
				"description" => "Write a header 1",
				"examples" => [
					[
						"code" => [
							"\$md->h1(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h1("Header")
					]
				],
			],
			"h2" => [
				"description" => "Write a header 2",
				"examples" => [
					[
						"code" => [
							"\$md->h2(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h2("Header")
					]
				],
			],
			"h3" => [
				"description" => "Write a header 3",
				"examples" => [
					[
						"code" => [
							"\$md->h3(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h3("Header")
					]
				],
			],
			"h4" => [
				"description" => "Write a header 4",
				"examples" => [
					[
						"code" => [
							"\$md->h4(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h4("Header")
					]
				],
			],
			"h5" => [
				"description" => "Write a header 5",
				"examples" => [
					[
						"code" => [
							"\$md->h5(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h5("Header")
					]
				],
			],
			"h6" => [
				"description" => "Write a header 6",
				"examples" => [
					[
						"code" => [
							"\$md->h6(\"Header\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->h6("Header")
					]
				],
			],
			"hr" => [
				"description" => "Write a horizontal rule",
				"examples" => [
					[
						"code" => [
							"\$md->write(\"A string\");",
							"\$md->hr();",
							"\$md->write(\"Another string\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->write("A string")->hr()->write("Another string")
					]
				],
			],
			"ulItem" => [
				"description" => "Write an unordered list item. Optionally provide the number of tabs to prepend to it",
				"examples" => [
					[
						"code" => [
							"\$md->ulItem(\"Item1\");",
							"\$md->ulItem(\"Item2\", 1);",
							"\$md->ulItem(\"Item3\", 2);",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->ulItem("Item1")->ulItem("Item2", 1)->ulItem("Item3", 2)
					]
				],
			],
			"olItem" => [
				"description" => "Write an ordered list item. Optionally provide the number of tabs to prepend to it and the string to prepend it with (defaults to 1)",
				"examples" => [
					[
						"code" => [
							"\$md->olItem(\"Item1\");",
							"\$md->olItem(\"Item2\", 1);",
							"\$md->olItem(\"Item3\", 2, \"123\");",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->olItem("Item1")->olItem("Item2", 1)->olItem("Item3", 2, "123")
					]
				],
			],
			"ul" => [
				"description" => "Write an unordered list. Use nested arrays to indicate nesting sublists.",
				"examples" => [
					[
						"code" => [
							"\$md->ul([",
							"    \"Item1\",",
							"    \"Item2\",",
							"    \"Item3\",",
							"    [",
							"        \"Subitems\",",
							"        [",
							"            \"SubSubItems...\"",
							"        ],",
							"    ],",
							"]);",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->ul([
							"Item1",
							"Item2",
							"Item3",
							[
								"Subitems",
								[
									"SubSubItems..."
								]
							]
						])
					]
				],
			],
			"ol" => [
				"description" => "Write an ordered list. Use nested arrays to indicate nesting sublists.",
				"examples" => [
					[
						"code" => [
							"\$md->ol([",
							"    \"Item1\",",
							"    \"Item2\",",
							"    \"Item3\",",
							"    [",
							"        \"Subitems\",",
							"        [",
							"            \"SubSubItems...\"",
							"        ],",
							"    ],",
							"]);",
							"echo(\$md);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())->ol([
							"Item1",
							"Item2",
							"Item3",
							[
								"Subitems",
								[
									"SubSubItems..."
								]
							]
						])
					]
				],
			],
			"blockQuote" => [
				"description" => "Write a blockquote. This supports a few different syntaxes:",
				"examples" => [
					[
						"code" => [
							"\$md->blockQuote(\"Pass a string for simple block quote...\");",
							"\$md->blockQuote([",
							"    \"Or an array for\",",
							"    \"a multiline block quote\",",
							"]);",
							"\$md->blockQuote(function(\$md) {",
					        "    \$md->p(\"This blockquote uses a callback\")",
					        "    ->p(\"This allows us to use the writer's functionality to create content\")",
					        "    ->blockQuote([",
					        "        \"including\",",
					        "        \"block quotes\"",
					        "    ]);",
					        "});",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->blockQuote("Pass a string for a simple block quote...")
							->blockQuote([
								"Or an array for",
								"a multiline block quote"
							])
							->blockQuote(function($md) {
					            $md->p("This blockquote uses a callback")
					            ->p("This allows us to use the writer's functionality to create content")
					            ->blockQuote([
					                "including",
					                "block quotes",
					            ]);
					        })
					]
				],
			],
			"codeBlock" => [
				"description" => "Write a \"fenced\" code block. Accepts a string or array of lines. Optionally pass a language for syntax highlighting as the second parameter.",
				"examples" => [
					[
						"code" => "\$md->codeBlock(\"echo('This is a code block');\");",
						"result" => "    ```php" . PHP_EOL . "    echo('This is a code block');" . PHP_EOL . "    ```"
					]
				],
			],
			"table" => [
				"description" => "Write a table. This expects an array of arrays where the first array is the header row, and the following arrays represent table rows.",
				"examples" => [
					[
						"code" => [
							"\$md->table([",
							"    [\"col1\", \"col2\", \"col3\"],",
							"    [\"val1\", \"val2\", \"val3\"],",
							"    [\"val1\", \"val2\", \"val3\"],",
							"]);",
						],
						"result" => (string)(new \MarkdownWriter\Writer())
							->table([
								["col1", "col2", "col3"],
								["val1", "val2", "val3"],
								["val1", "val2", "val3"],
							])
					],
				],
			],
		],
	],
	"Configuration/Misc" => [
		"description" => "All other methods",
		"methods" => [
			"setEOL" => [
				"description" => "Set the EOL string. By default this is set to `PHP_EOL`",
				"examples" => [],
			],
			"eol" => [
				"description" => "Get the EOL string",
				"examples" => [],
			],
			"__toString" => [
				"description" => "Returns the markdown result string",
				"examples" => [],
			],
		],
	],
];

foreach ($map as $category => $data) {
	$md->h2($category);
	if (!empty($data["description"])) $md->p($data["description"]);
	foreach ($data["methods"] as $method => $methodData) {
		$md->h3($method);
		$md->p($methodData["description"]);
		foreach ($methodData["examples"] as $example) {
			if (!empty($example["code"])) $md->codeBlock($example["code"], "php");
			if (!empty($example["result"])) $md->codeBlock($example["result"], "markdown");
		}
	}
}

file_put_contents(__DIR__ . "/README.md", $md->__toString());