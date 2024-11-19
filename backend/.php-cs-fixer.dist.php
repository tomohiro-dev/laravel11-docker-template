<?php declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(false)
    ->setRules([
        '@PSR2' => true,
        'align_multiline_comment' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'align_double_arrow' => false,
            'align_equals' => false,
        ],
        'blank_line_after_opening_tag' => false,
        'blank_line_before_statement' => [
            'statements' => [
                'do',
                'for',
                'foreach',
                'if',
                'switch',
                'try',
            ],
        ],
        'cast_spaces' => true,
        'class_attributes_separation' => false,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => true,
        // 'declare_strict_types' => true, // risky
        // 'dir_constant' => true, // risky
        // 'ereg_to_preg' => true, // risky
        'escape_implicit_backslashes' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        // 'final_internal_class' => true, // risky
        // 'function_to_constant' => true, // risky
        'function_typehint_space' => true,
        'general_phpdoc_annotation_remove' => [
            'annotations' => [
                'class',
                'package',
                'author',
            ],
        ],
        'global_namespace_import' => true,
        'single_line_comment_style' => true,
        'heredoc_to_nowdoc' => true,
        'include' => true,
        // 'is_null' => ['use_yoda_style' => false], // risky
        'linebreak_after_opening_tag' => false,
        'list_syntax' => [
            'syntax' => 'short'
        ],
        'lowercase_cast' => true,
        'magic_constant_casing' => true,
        'method_chaining_indentation' => true,
        'class_attributes_separation' => true,
        // 'modernize_types_casting' => true, // risky
        'native_function_casing' => true,
        // 'no_alias_functions' => true, // risky
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'break',
                'continue',
                'extra',
                'return',
                'throw',
                'use',
                'parenthesis_brace_block',
                'square_brace_block',
                'curly_brace_block',
            ],
        ],
        // 'no_homoglyph_names' => true, // risky
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_null_property_initialization' => true,
        // 'no_php4_constructor' => true, // risky
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        // 'no_unneeded_final_method' => true, // risky
        // 'no_unreachable_default_argument_value' => true, // risky
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        // 'php_unit_construct' => true, // risky
        // 'php_unit_dedicate_assert' => true, // risky
        // 'php_unit_mock' => true, // risky
        // 'php_unit_namespaced' => true, // risky
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        'general_phpdoc_tag_rename' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_no_package' => true,
        'phpdoc_order' => false,
        'phpdoc_return_self_reference' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => false,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'phpdoc_var_without_name' => true,
        // 'pow_to_exponentiation' => true, // risky
        'protected_to_private' => true,
        // 'random_api_migration' => true, // risky
        'return_type_declaration' => true,
        // 'self_accessor' => true, // risky
        'semicolon_after_instruction' => true,
        'short_scalar_cast' => true,
        'simplified_null_return' => true,
        'single_blank_line_before_namespace' => true,
        'single_line_comment_style' => false,
        'single_quote' => true,
        'space_after_semicolon' => ['remove_in_empty_for_expressions' => true],
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        // 'void_return' => true, // risky
        'whitespace_after_comma_in_array' => true,
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
        ],
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude([
            'bootstrap',
            'database/migrations',
            'public',
            'resources/views',
            'storage',
            'vendor',
            '.phpstorm.meta.php',
            '_ide_helper.php',
            '_ide_helper_models.php',
            'server.php',
        ])->in(__DIR__)
    )
;