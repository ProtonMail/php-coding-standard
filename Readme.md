# Proton PHP Coding Standards

![PHP from Packagist](https://img.shields.io/packagist/php-v/protonlabs/php-coding-standard.svg?style=flat-square)
![Packagist Version](https://img.shields.io/packagist/v/protonlabs/php-coding-standard.svg?style=flat-square)

## Installation & Usage

Install the package with composer

```sh
composer req protonlabs/php-coding-standard --dev
```

To use it in your phpcs xml, add a rule pointing to the ruleset.xml

```xml
<?xml version="1.0"?>
<ruleset name="ProtonLabs PHP CodeSniffer Standard">
    <!-- Proton Coding Standard – https://github.com/ProtonMail/php-coding-standard -->
    <rule ref="vendor/protonlabs/php-coding-standard/Proton/ruleset.xml">
        <!-- sniffs to exclude -->
        <!-- <exclude name="SlevomatCodingStandard.PHP.UselessParentheses"/> -->
    </rule>

    <exclude-pattern>*/vendor/*</exclude-pattern>
</ruleset>
```
