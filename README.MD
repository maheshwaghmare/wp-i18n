
## WP I18N

Translate the WordPress by by re-using existing translated strings with the help of WP CLI.

## Use Exported Database/XML

## WP CLI Commands

// START
wp wpi18n import_translated_strings en_AU
wp wpi18n temp_ids en_AU
wp wpi18n set_most_repeated_string_as_top en_AU ----- en_AU
wp wpi18n generate_blank_lang_po en_AU
wp wpi18n generate_filled_lang_po en_AU
// END

wp wpi18n detect_all_repeated_string hi

az - DONE
br - DONE
hi - DONE (Created the lang PO)
en_AU - en-au - WIP
en_CA
en_GB
en_NZ
es_ES
ro_RO
sv_SE 
fr_FR
it_IT
de_DE



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


