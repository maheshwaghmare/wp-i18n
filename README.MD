## WP I18N

Translate the WordPress by by re-using existing translated strings with the help of WP CLI.

## Use Exported Database/XML

## WP CLI Commands

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
