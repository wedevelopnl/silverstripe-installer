<?php

use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;
use SilverStripe\i18n\i18n;
use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;

i18n::set_locale('nl_NL');

$validator = PasswordValidator::create();
Member::set_password_validator($validator);

// wysiwyg settings
$formats = [
    [
        'title' => 'Heading sizes',
        'items' => [
            [
                'title' => 'H1',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-1',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'H2',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-2',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'H3',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-3',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'H4',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-4',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'H5',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-5',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'H6',
                'selector' => 'h1, h2, h3, h4, h5, h6',
                'classes' => 'is-size-6',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
        ],
    ],
    [
        'title' => 'Text sizes',
        'items' => [
            [
                'title' => 'Text larger',
                'selector' => 'p, ul, ol',
                'classes' => 'is-size-5',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'Text large',
                'selector' => 'p, ul, ol',
                'classes' => 'is-size-6',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'Text normal',
                'selector' => 'p, ul, ol',
                'classes' => 'is-size-7',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'Text small',
                'selector' => 'p, ul, ol',
                'classes' => 'is-size-8',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
            [
                'title' => 'Text smaller',
                'selector' => 'p, ul, ol',
                'classes' => 'is-size-9',
                'wrapper' => true,
                'merge_siblings' => false,
            ],
        ],
    ],
    [
        'title' => 'Link styles',
        'items' => [
            [
                'title' => 'Theme button',
                'selector' => 'a',
                'classes' => 'button is-theme',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
            [
                'title' => 'Blue button',
                'selector' => 'a',
                'classes' => 'button is-primary',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
            [
                'title' => 'Orange button',
                'selector' => 'a',
                'classes' => 'button is-secondary',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
            [
                'title' => 'Green button',
                'selector' => 'a',
                'classes' => 'button is-tertiary',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
            [
                'title' => 'Yellow button',
                'selector' => 'a',
                'classes' => 'button is-quartiary',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
            [
                'title' => 'White button',
                'selector' => 'a',
                'classes' => 'button is-white',
                'wrapper' => false,
                'merge_siblings' => true,
            ],
        ],
    ],
];

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styleselect')
    ->setOptions([
        'importcss_append' => true,
        'style_formats' => $formats,
    ]);

HtmlEditorConfig::get('cms')
    ->setOption('block_formats', 'Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Paragraph=p;Blockquote=blockquote;Preformatted=pre;Div=div');
