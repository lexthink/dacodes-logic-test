<?php

$header = <<<EOF
This file is part of the lexthink/logic package.

(c) Manuel Alejandro Paz Cetina <lexthink@icloud.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        // symfony
        'class_attributes_separation' => true,
        'whitespace_after_comma_in_array' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => true,
        'function_typehint_space' => true,
        'no_alias_functions' => true,
        'trailing_comma_in_multiline_array' => true,
        'new_with_braces' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'object_operator_without_whitespace' => true,
        'binary_operator_spaces' => true,
        'phpdoc_scalar' => true,
        'self_accessor' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'single_quote' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_unused_imports' => true,
        'no_whitespace_in_blank_line' => true,
        'yoda_style' => ['equal' => true, 'identical' => true, 'less_and_greater' => null],
        'standardize_not_equals' => true,
        // contrib
        'concat_space' => ['spacing' => 'one'],
        'not_operator_with_successor_space' => true,
        'single_blank_line_before_namespace' => true,
        'linebreak_after_opening_tag' => true,
        'blank_line_after_opening_tag' => true,
        'ordered_imports' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('vendor')
            ->in(__DIR__)
    )
;