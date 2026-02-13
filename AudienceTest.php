{
    "name": "voya/drupal-platform",
    "type": "project",
    "description": "Voya Financial's Drupal platform.",
    "license": "GPL-2.0-only",
    "require": {
        "php": "^8.0",
        "ext-curl": "*",
        "ext-dom": "*",
        "ext-gd": "*",
        "ext-intl": "*",
        "ext-json": "*",
        "ext-mbstring": "*",
        "ext-xml": "*",
        "ext-zend-opcache": "*",
        "bower-asset/cropper": "^4.1.0",
        "bower-asset/slick-carousel": "^1.8",
        "bower-asset/swagger-ui": "^5.27.0",
        "consolidation/robo": "^5.0",
        "cweagans/composer-patches": "^1.7",
        "drupal/access_unpublished": "^1.5",
        "drupal/address": "^2.0",
        "drupal/amazon_sns": "^1.2",
        "drupal/apigee_api_catalog": "^3.0",
        "drupal/apigee_edge": "^4.0",
        "drupal/auto_entitylabel": "^3.0@beta",
        "drupal/better_exposed_filters": "^7.0",
        "drupal/block_permissions": "^1.0",
        "drupal/bynder": "^4.2",
        "drupal/chosen": "^5.0",
        "drupal/classy": "^2.0.0",
        "drupal/color": "^2.0@alpha",
        "drupal/config_override": "^2.0",
        "drupal/content_moderation_notifications": "^3.3",
        "drupal/core-composer-scaffold": "^11.0.0",
        "drupal/core-recommended": "^11.0.0",
        "drupal/default_content": "^2.0@alpha",
        "drupal/diff": "^1.0@RC",
        "drupal/easy_breadcrumb": "^2.0",
        "drupal/editor_advanced_link": "^2.1",
        "drupal/editoria11y": "^2.1",
        "drupal/embed": "^1.4",
        "drupal/entity_block": "^2.0",
        "drupal/entity_embed": "^1.1",
        "drupal/feeds": "^3.0@beta",
        "drupal/feeds_ex": "^1.0@alpha",
        "drupal/feeds_tamper": "^2.0@beta",
        "drupal/field_group": "^4.0",
        "drupal/focal_point": "^2.0",
        "drupal/fullcalendar": "^3.0",
        "drupal/geocoder": "^4.0",
        "drupal/geofield": "^10.3",
        "drupal/google_tag": "^2.0",
        "drupal/honeypot": "^2.0",
        "drupal/http_response_headers": "^3.0",
        "drupal/imageapi_optimize": "^4.0@beta",
        "drupal/imageapi_optimize_resmushit": "^2.1@beta",
        "drupal/inline_entity_form": "^3.0@RC",
        "drupal/jquery_ui": "^1.6",
        "drupal/layout_builder_modal": "^2.0",
        "drupal/layout_builder_restrictions": "^3.0",
        "drupal/layout_library": "^1.0",
        "drupal/lightning_media": "^5.0",
        "drupal/link_attributes": "^2.1",
        "drupal/linkit": "^7.0",
        "drupal/media_entity_browser": "^3.0",
        "drupal/media_entity_generic": "^1.0",
        "drupal/memory_limit_policy": "^2.0",
        "drupal/metatag": "^2.0",
        "drupal/moderation_dashboard": "^3.0",
        "drupal/moderation_sidebar": "^1.2",
        "drupal/pantheon_advanced_page_cache": "^2.0",
        "drupal/pantheon_secrets": "^1.0",
        "drupal/paragraphs": "^1.9",
        "drupal/paragraphs_asymmetric_translation_widgets": "^1.2",
        "drupal/pathauto": "^1.6",
        "drupal/rabbit_hole": "^1.0",
        "drupal/redirect": "^1.4",
        "drupal/redis": "^1.5",
        "drupal/remote_stream_wrapper": "^2.0",
        "drupal/search_api": "^1.8",
        "drupal/search_api_pantheon": "^8.4",
        "drupal/seckit": "^2.0",
        "drupal/section_library": "^2.0",
        "drupal/shs": "^2.0@RC",
        "drupal/simplesamlphp_auth": "^4.1",
        "drupal/sitemap": "^2.0@beta",
        "drupal/swagger_ui_formatter": "^4.0",
        "drupal/telephone_formatter": "^1.0",
        "drupal/twig_tweak": "^3.2",
        "drupal/views_ajax_history": "^1.7",
        "drupal/views_autosubmit": "^1.0",
        "drupal/views_data_export": "^1.3",
        "drupal/views_infinite_scroll": "^2.0",
        "drupal/views_taxonomy_term_name_into_id": "^1.0@alpha",
        "drupal/webform": "^6.3@beta",
        "drupal/xls_serialization": "^2.0",
        "drush/drush": "^13.7.1",
        "geocoder-php/bing-maps-provider": "^4.0",
        "giggsey/libphonenumber-for-php": "^8.12",
        "npm-asset/css-element-queries": "^1.2",
        "npm-asset/dompurify": "^3.1",
        "npm-asset/dropzone": "^5.7.4",
        "npm-asset/jquery-ui-touch-punch": "^0.2.3",
        "oomphinc/composer-installers-extender": "^2.0",
        "pantheon-systems/drupal-integrations": "^11",
        "spatie/calendar-links": "^1.11.0",
        "spatie/icalendar-generator": "^3.0",
        "voya/voya_proofpoint": "^1.0",
        "wikimedia/composer-merge-plugin": "^2.0"
    },
    "require-dev": {
        "acquia/coding-standards": "^3.0.1",
        "behat/behat": "^3.1",
        "dmore/behat-chrome-extension": "^1.4",
        "drupal/config_inspector": "^2.1",
        "drupal/core-dev": "^11.0.0",
        "drupal/devel": "^5.0",
        "drupal/drupal-extension": "^5.1",
        "drupal/examples": "^4.0",
        "drupal/masquerade": "^2.0@beta",
        "drupal/schemadotorg": "^1.0",
        "drupal/upgrade_status": "^4.0",
        "enlightn/security-checker": "^1.3",
        "jarnaiz/behat-junit-formatter": "^1.3.2",
        "mglaman/drupal-check": "^1.4",
        "phpspec/prophecy-phpunit": "^2"
    },
    "config": {
        "platform": {
            "php": "8.3"
        },
        "sort-packages": true,
        "allow-plugins": {
            "composer/installers": true,
            "cweagans/composer-patches": true,
            "dealerdirect/phpcodesniffer-composer-installer": true,
            "drupal/console-extend-plugin": false,
            "drupal/core-composer-scaffold": true,
            "oomphinc/composer-installers-extender": true,
            "php-http/discovery": false,
            "phpstan/extension-installer": true,
            "simplesamlphp/composer-module-installer": true,
            "simplesamlphp/composer-xmlprovider-installer": false,
            "tbachert/spi": true,
            "wikimedia/composer-merge-plugin": true
        },
        "audit": {
            "block-insecure": false,
            "abandoned": "report"
        }
    },
    "extra": {
        "composer-exit-on-patch-failure": true,
        "drupal-scaffold": {
            "locations": {
                "web-root": "./docroot"
            },
            "file-mapping": {
                "[web-root]/web.config": false,
                "[web-root]/.ht.router.php": false,
                "[web-root]/.htaccess": false,
                "[project-root]/.drush-lock-update": false
            }    
        },
        "enable-patching": true,
        "installer-paths": {
            "docroot/core": [
                "type:drupal-core"
            ],
            "docroot/modules/contrib/{$name}": [
                "type:drupal-module"
            ],
            "docroot/modules/custom/{$name}": [
                "type:drupal-custom-module"
            ],
            "docroot/profiles/contrib/{$name}": [
                "type:drupal-profile"
            ],
            "docroot/profiles/custom/{$name}": [
                "type:drupal-custom-profile"
            ],
            "docroot/themes/contrib/{$name}": [
                "type:drupal-theme"
            ],
            "docroot/themes/custom/{$name}": [
                "type:drupal-custom-theme"
            ],
            "docroot/libraries/{$name}": [
                "type:drupal-library",
                "type:bower-asset",
                "type:npm-asset"
            ],
            "drush/Commands/{$name}": [
                "type:drupal-drush"
            ]
        },
        "installer-types": [
            "bower-asset",
            "npm-asset"
        ],
        "merge-plugin": {
            "include": [
                "docroot/modules/contrib/webform/composer.libraries.json",
                "docroot/modules/contrib/chosen/composer.libraries.json"
            ]
        },
        "patchLevel": {
            "drupal/core": "-p2"
        },
        "patches": {
            "drupal/content_moderation_notifications": {
                "3133940 - Add option to email revision author": "https://www.drupal.org/files/issues/2022-09-14/content-moderation-notifications-3133940-6.patch"
            },
            "drupal/core": {
                "3097407 - Fix for vertical tab accessibility issue in claro theme ": "https://www.drupal.org/files/issues/2019-11-29/claro-fix_node_sidebar_accordion_items-3097407-4--fix-only.patch",
                "3047022 - Layout builder fails to assign inline block access dependencies for the overrides section storage on entities with pending revisions": "https://www.drupal.org/files/issues/2021-03-22/3047022-71.patch",
                "3080606 - Reorder Layout sections ": "https://www.drupal.org/files/issues/2024-06-13/3080606-121.patch",
                "3177977 - Form state storage changes in #process callbacks are not cached during form rebuild": "https://www.drupal.org/files/issues/2020-10-20/3177977-form-builder-rebuild-form-cache-2.patch",
                "3260208 - Corrupted router during installation": "patches/3260208.patch",
                "2984272 - Dots in query parameter names converted to underscores": "https://www.drupal.org/files/issues/2021-06-16/fix-mangled-query-parameter-names-2984272-59.patch",
                "3400945 - Allow language negotiator override": "patches/3400945.patch",
                "2873353 - allow allowed values function update": "https://www.drupal.org/files/issues/2021-05-18/allow-allowed-values-function-update-D9-2873353_1.patch",
                "3468860 - JS #states behavior does not have a detach method": "patches/3468860.patch",
                "3566429 - Update to 10.6.0 fails due to nodejs version incompatibility": "patches/3566429-drupal-core-10.6.0-nodejs-fix.patch"
            },
            "drupal/default_content": {
                "3160146 - Allow layout_builder pages to be exported/imported": "https://www.drupal.org/files/issues/2022-05-15/default_content-3160146-52.patch"
            },
            "drupal/entity_block": {
                "3303350 - add schema": "https://www.drupal.org/files/issues/2022-08-15/entity_block-missing-schema-3303350-2.patch"
            },
            "drupal/entity_embed": {
              "3067452 - Recursive Limit Breaks Normal, Repeated Use of a Media item on a page": "https://www.drupal.org/files/issues/2019-09-29/3067452-5.patch",
              "3531672 - Drupal 10.5/11.2 compatability (tooltip broken, cannot edit embedded entities)": "patches/entity_embed--2025-06-30--3531672--mr-62.patch"
            },
            "drupal/field_group": {
                "2969051 - HTML5 Validation Prevents Submission in Tabs": "https://www.drupal.org/files/issues/2024-08-09/2969051-148.patch"
            },
            "drupal/fullcalendar": {
                "3511172 - Missing schema": "patches/3511172.patch",
                "3527506 - Extensible javascript FullCalendar object": "patches/3527506.patch"
            },
            "drupal/geofield": {
                "Custom: add missing schema for geofield proximity views field": "patches/add-views-geofield-proximity.patch"
            },
            "drupal/key": {
                "Custom - Fix textarea maxlength": "patches/key-textarea-fix.patch"
            },
            "drupal/paragraphs": {
                "3090200 - Incorrect parent revision ID is being passed in ParagraphAccessControlHandler::checkAccess()": "https://www.drupal.org/files/issues/2020-07-08/access-controll-issue-3090200-22.patch"
            },
            "drupal/redirect": {
                "3194561 - Double encoding (drupal.org/project/redirect/issues/3194561)": "https://www.drupal.org/files/issues/2021-01-29/redirect-doubleEncoded-3194561-3.patch",
                "Customized - 2884630 - Support for encoded URLs with spaces or special characters (drupal.org/project/redirect/issues/2884630)": "patches/redirect-2884630-25-customized.patch"
            },
            "drupal/color": {
                "2995825 - Color css files are not regenerated after deployment": "https://www.drupal.org/files/issues/2023-03-01/2995825-71.patch"
            },
            "drupal/remote_stream_wrapper": {
                "3068898 - Image styles setting extension cause access denied": "patches/3068898.patch"
            },
            "drupal/google_tag": {
                "3549374 - Synchronous JS in <head> blocks the critical render path": "patches/3549374.patch"
            }
        },
        "patches-ignore": {
            "drupal/lightning_core": {
                "drupal/core": {
                    "2869592 - Disabled update module shouldn't produce a status report warning": "https://www.drupal.org/files/issues/2869592-remove-update-warning-7.patch"
                }
            }
        }
    },
    "autoload": {
        "psr-4": {
            "Voya\\": "src/Voya/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Drupal\\Tests\\PHPUnit\\": "tests/phpunit/src/"
        }
    },
    "repositories": {
        "drupal": {
            "type": "composer",
            "url": "https://packages.drupal.org/8"
        },
        "asset-packagist": {
            "type": "composer",
            "url": "https://asset-packagist.org"
        },
        "ckeditor_templates": {
            "type": "package",
            "package": {
                "name": "ckeditor/templates",
                "version": "4.11.1",
                "type": "drupal-library",
                "dist": {
                    "url": "https://download.ckeditor.com/templates/releases/templates_4.11.1.zip",
                    "type": "zip"
                },
                "require": {
                    "composer/installers": "~1.0"
                }
            }
        },
        "voya/voya_proofpoint": {
            "type": "vcs",
            "url": "https://github.voya.net/Voya/drupal-proofpoint"
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true,
    "scripts": {
        "post-install-cmd": ["vendor/bin/robo voya:composer:hook:install"],
        "post-update-cmd": ["vendor/bin/robo voya:composer:hook:update"],
        "nuke": [
            "rm -rf vendor docroot/core docroot/modules/contrib docroot/profiles/contrib docroot/themes/contrib",
            "@composer clearcache --ansi",
            "@composer install --ansi"
        ]
    }
}
