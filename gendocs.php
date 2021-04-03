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
->write("A library for generating markdown using PHP. This library provides a class for building markdown following the " . $md->link("CommonMark", "https://commonmark.org") . " specification and providing support for some common extensions including:")
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
		"description" => "Methods that write a block to the markdown string",
		"methods" => [
			"write" => [
				"description" => "",
				"examples" => [],
			],
			"newLine" => [
				"description" => "",
				"examples" => [],
			],
			"nl" => [
				"description" => "",
				"examples" => [],
			],
			"h1" => [
				"description" => "",
				"examples" => [],
			],
			"h2" => [
				"description" => "",
				"examples" => [],
			],
			"h3" => [
				"description" => "",
				"examples" => [],
			],
			"h4" => [
				"description" => "",
				"examples" => [],
			],
			"h5" => [
				"description" => "",
				"examples" => [],
			],
			"h6" => [
				"description" => "",
				"examples" => [],
			],
			"p" => [
				"description" => "",
				"examples" => [],
			],
			"hr" => [
				"description" => "",
				"examples" => [],
			],
			"block" => [
				"description" => "",
				"examples" => [],
			],
			"ul" => [
				"description" => "",
				"examples" => [],
			],
			"ol" => [
				"description" => "",
				"examples" => [],
			],
			"ulItem" => [
				"description" => "",
				"examples" => [],
			],
			"olItem" => [
				"description" => "",
				"examples" => [],
			],
			"blockQuote" => [
				"description" => "",
				"examples" => [],
			],
			"codeBlock" => [
				"description" => "",
				"examples" => [],
			],
			"table" => [
				"description" => "",
				"examples" => [],
			],
		],
	],
	"Configuration/Misc" => [
		"description" => "All other methods",
		"methods" => [
			"setEOL" => [
				"description" => "",
				"examples" => [],
			],
			"eol" => [
				"description" => "",
				"examples" => [],
			],
			"__toString" => [
				"description" => "",
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
			if (!empty($example["code"])) {
				$md->codeBlock($example["code"], "php");
			}
			if (!empty($example["result"])) {
				$md->codeBlock($example["result"], "markdown");
			}
		}
	}
}

file_put_contents(__DIR__ . "/README.md", $md->__toString());