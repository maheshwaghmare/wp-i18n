
## WP I18N

Translate the WordPress by by re-using existing translated strings with the help of WP CLI.

## Use Exported Database/XML

## WP CLI Commands

// START

	'af'         => 'Afrikaans',
	'ak'         => 'Akan',
	'sq'         => 'Albanian',
	'arq'        => 'Algerian Arabic',
	'am'         => 'Amharic',
	'ar'         => 'Arabic',
	'hy'         => 'Armenian',
	'rup'        => 'Aromanian',
	'frp'        => 'Arpitan',
	'as'         => 'Assamese',
	'ast'        => 'Asturian',
	'az'         => 'Azerbaijani',
	'az-tr'      => 'Azerbaijani (Turkey)',
	'bcc'        => 'Balochi Southern',
	'ba'         => 'Bashkir',
	'eu'         => 'Basque',
	'bel'        => 'Belarusian',
	'bn'         => 'Bengali',
	'bs'         => 'Bosnian',
	'br'         => 'Breton',
	'bg'         => 'Bulgarian',
	'ca'         => 'Catalan',
	'bal'        => 'Catalan (Balear)',
	'ceb'        => 'Cebuano',
	'zh-cn'      => 'Chinese (China)',
	'zh-hk'      => 'Chinese (Hong Kong)',
	'zh-sg'      => 'Chinese (Singapore)',
	'zh-tw'      => 'Chinese (Taiwan)',
	'co'         => 'Corsican',
	'hr'         => 'Croatian',
	'cs'         => 'Czech',
	'da'         => 'Danish',
	'dv'         => 'Dhivehi',
	'nl'         => 'Dutch',
	'nl-be'      => 'Dutch (Belgium)',
	'dzo'        => 'Dzongkha',
	'art-xemoji' => 'Emoji',
	'en-au'      => 'English (Australia)',
	'en-ca'      => 'English (Canada)',
	'en-nz'      => 'English (New Zealand)',
	'pirate'     => 'English (Pirate)',
	'en-za'      => 'English (South Africa)',
	'en-gb'      => 'English (UK)',
	'eo'         => 'Esperanto',
	'et'         => 'Estonian',
	'ee'         => 'Ewe',
	'fo'         => 'Faroese',
	'fi'         => 'Finnish',
	'fr-be'      => 'French (Belgium)',
	'fr-ca'      => 'French (Canada)',
	'fr'         => 'French (France)',
	'fy'         => 'Frisian',
	'fur'        => 'Friulian',
	'fuc'        => 'Fulah',
	'gl'         => 'Galician',
	'ka'         => 'Georgian',
	'de'         => 'German',
	'de-ch'      => 'German (Switzerland)',
	'el'         => 'Greek',
	'kal'        => 'Greenlandic',
	'gn'         => 'Guaraní',
	'gu'         => 'Gujarati',
	'hat'        => 'Haitian Creole',
	'hau'        => 'Hausa',
	'haw'        => 'Hawaiian',
	'haz'        => 'Hazaragi',
	'he'         => 'Hebrew',
	'hi'         => 'Hindi',
	'hu'         => 'Hungarian',
	'is'         => 'Icelandic',
	'ido'        => 'Ido',
	'id'         => 'Indonesian',
	'ga'         => 'Irish',
	'it'         => 'Italian',
	'ja'         => 'Japanese',
	'jv'         => 'Javanese',
	'kab'        => 'Kabyle',
	'kn'         => 'Kannada',
	'kk'         => 'Kazakh',
	'km'         => 'Khmer',
	'kin'        => 'Kinyarwanda',
	'ko'         => 'Korean',
	'ckb'        => 'Kurdish (Sorani)',
	'kir'        => 'Kyrgyz',
	'lo'         => 'Lao',
	'lv'         => 'Latvian',
	'li'         => 'Limburgish',
	'lin'        => 'Lingala',
	'lt'         => 'Lithuanian',
	'lmo'        => 'Lombard',
	'lug'        => 'Luganda',
	'lb'         => 'Luxembourgish',
	'mk'         => 'Macedonian',
	'mg'         => 'Malagasy',
	'ms'         => 'Malay',
	'ml'         => 'Malayalam',
	'mlt'        => 'Maltese',
	'mri'        => 'Maori',
	'mr'         => 'Marathi',
	'mfe'        => 'Mauritian Creole',
	'xmf'        => 'Mingrelian',
	'mn'         => 'Mongolian',
	'me'         => 'Montenegrin',
	'ary'        => 'Moroccan Arabic',
	'mya'        => 'Myanmar (Burmese)',
	'ne'         => 'Nepali',
	'nb'         => 'Norwegian (Bokmål)',
	'nn'         => 'Norwegian (Nynorsk)',
	'oci'        => 'Occitan',
	'ory'        => 'Oriya',
	'os'         => 'Ossetic',
	'pap'        => 'Papiamento',
	'ps'         => 'Pashto',
	'fa'         => 'Persian',
	'fa-af'      => 'Persian (Afghanistan)',
	'pl'         => 'Polish',
	'pt-br'      => 'Portuguese (Brazil)',
	'pt'         => 'Portuguese (Portugal)',
	'pa'         => 'Punjabi',
	'rhg'        => 'Rohingya',
	'ro'         => 'Romanian',
	'roh'        => 'Romansh',
	'ru'         => 'Russian',
	'rue'        => 'Rusyn',
	'sah'        => 'Sakha',
	'sa-in'      => 'Sanskrit',
	'skr'        => 'Saraiki',
	'srd'        => 'Sardinian',
	'gd'         => 'Scottish Gaelic',
	'sr'         => 'Serbian',
	'sna'        => 'Shona',
	'sq-xk'      => 'Shqip (Kosovo)',
	'scn'        => 'Sicilian',
	'szl'        => 'Silesian',
	'snd'        => 'Sindhi',
	'si'         => 'Sinhala',
	'sk'         => 'Slovak',
	'sl'         => 'Slovenian',
	'so'         => 'Somali',
	'azb'        => 'South Azerbaijani',
	'es-ar'      => 'Spanish (Argentina)',
	'es-cl'      => 'Spanish (Chile)',
	'es-co'      => 'Spanish (Colombia)',
	'es-cr'      => 'Spanish (Costa Rica)',
	'es-gt'      => 'Spanish (Guatemala)',
	'es-mx'      => 'Spanish (Mexico)',
	'es-pe'      => 'Spanish (Peru)',
	'es-pr'      => 'Spanish (Puerto Rico)',
	'es'         => 'Spanish (Spain)',
	'es-ve'      => 'Spanish (Venezuela)',
	'su'         => 'Sundanese',
	'sw'         => 'Swahili',
	'ssw'        => 'Swati',
	'sv'         => 'Swedish',
	'gsw'        => 'Swiss German',
	'syr'        => 'Syriac',
	'tl'         => 'Tagalog',
	'tah'        => 'Tahitian',
	'tg'         => 'Tajik',
	'tzm'        => 'Tamazight (Central Atlas)',
	'ta'         => 'Tamil',
	'ta-lk'      => 'Tamil (Sri Lanka)',
	'tt'         => 'Tatar',
	'te'         => 'Telugu',
	'th'         => 'Thai',
	'bo'         => 'Tibetan',
	'tir'        => 'Tigrinya',
	'tr'         => 'Turkish',
	'tuk'        => 'Turkmen',
	'twd'        => 'Tweants',
	'ug'         => 'Uighur',
	'uk'         => 'Ukrainian',
	'ur'         => 'Urdu',
	'uz'         => 'Uzbek',
	'vi'         => 'Vietnamese',
	'wa'         => 'Walloon',
	'cy'         => 'Welsh',
	'xho'        => 'Xhosa',
	'yor'        => 'Yoruba',
	'zul'        => 'Zulu',

------------

wp wpi18n download_all_core_files en-nz
wp wpi18n import_translated_strings en-nz
wp wpi18n temp_ids en-nz
wp wpi18n set_most_repeated_string_as_top en-nz ----- en-nz
wp wpi18n generate_blank_lang_po en-nz
wp wpi18n generate_filled_lang_po en-nz

// END
------------

wp wpi18n detect_all_repeated_string hi

az - DONE
br - DONE
hi - DONE (Created the lang PO)
en_AU - Done
en_CA - Done
en_GB - Done
en-nz - Done
es
ro
sv
fr
it
de

All Files Log here - https://docs.google.com/spreadsheets/d/1s2RMLE1qslIwdEOqsKPrRbUPRyermiA0qC8Z7TjxIJ8/edit#gid=878822179

1.  info
2.  clean_tracking

3.  download_plugin_po
4.  download_theme_po
5.  generate_theme_po
6.  generate_plugin_po

7.  set_most_repeated_string_as_top
8.  download_all_core_files
9.  download_all_theme_files
10. translate_all_plugin_files
11. translate_all_theme_files

12. getDirContents
13. track_file
14. import
15. translate
16. test
17. tmp

1. wp wpi18n download_plugin_po {slug} --lang={mr}
2. wp wpi18n download_theme_po  {slug} --lang={mr}

3. wp wpi18n generate_plugin_po {slug} --lang={mr}
4. wp wpi18n generate_theme_po  {slug} --lang={mr}

### 1. wp wpi18n download_plugin_po {slug} --lang={mr}

Download individual plugin .po files by plugin slug.

Syntax Command:  wp wpi18n download_plugin_po {plugin-slug} --lang={language}
Example Command: wp wpi18n download_plugin_po contact-form-7 --lang='mr'

### 2. wp wpi18n download_theme_po {slug} --lang={mr}

Download individual theme .po file by theme slug.

Syntax Command:  wp wpi18n download_theme_po {theme-slug} --lang={language}
Example Command: wp wpi18n download_theme_po bhari --lang='mr'

--

### 1. wp wpi18n download_all_core_files

Download all the files from WordPress project versions ['dev', '4.8.x', '4.7.x', '4.6.x', '4.5.x', '4.4.x', '4.3.x', '4.2.x', '4.1.x'].

E.g. We download all .po files from below Russian language.

```
/**
 * Russian
 * Русский
 * ru_RU
 * Locale Glossary
 * https://translate.wordpress.org/locale/ru
 */
https://translate.wordpress.org/projects/wp/dev/ru/default
https://translate.wordpress.org/projects/wp/dev/cc/ru/default
https://translate.wordpress.org/projects/wp/dev/admin/ru/default
https://translate.wordpress.org/projects/wp/dev/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.8.x/ru/default
https://translate.wordpress.org/projects/wp/4.8.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.8.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.8.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.7.x/ru/default
https://translate.wordpress.org/projects/wp/4.7.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.7.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.7.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.6.x/ru/default
https://translate.wordpress.org/projects/wp/4.6.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.6.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.6.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.5.x/ru/default
https://translate.wordpress.org/projects/wp/4.5.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.5.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.5.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.4.x/ru/default
https://translate.wordpress.org/projects/wp/4.4.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.4.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.4.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.3.x/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.3.x/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.3.x/admin/network/ru/default

https://translate.wordpress.org/projects/wp/4.1.x/ru/default
https://translate.wordpress.org/projects/wp/4.1.x/cc/ru/default
https://translate.wordpress.org/projects/wp/4.1.x/admin/ru/default
https://translate.wordpress.org/projects/wp/4.1.x/admin/network/ru/default
```

### 2. wp wpi18n clean_tracking

While downloading the files we keep the track of the downloaded.

### 3. wp wpi18n import

It import all the strings from downlaoded .po files. E.g. It visit all the .po files e.g.

```
- /po-files/wordpress/af\4.1.x\wp-4.1.x-admin-af.po
- /po-files/wordpress/af\4.1.x\wp-4.1.x-admin-network-af.po
- /po-files/wordpress/af\4.1.x\wp-4.1.x-af.po
- /po-files/wordpress/af\4.1.x\wp-4.1.x-cc-af.po

- /po-files/wordpress/ru\4.1.x\wp-4.1.x-admin-ru.po
- /po-files/wordpress/ru\4.1.x\wp-4.1.x-admin-network-ru.po
- /po-files/wordpress/ru\4.1.x\wp-4.1.x-ru.po
- /po-files/wordpress/ru\4.1.x\wp-4.1.x-cc-ru.po

- etc.
```


