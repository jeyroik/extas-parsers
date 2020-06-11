![tests](https://github.com/jeyroik/extas-parsers/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-parsers/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/extas-parsers/maintainability"><img src="https://api.codeclimate.com/v1/badges/5161d1e4fd84a9aeadd6/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-players/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-players/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-players/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

# Описание

Пакет предоставляет парсеры.

# Использование

```php
$parser = SystemContainer::getItem(IParserRepository::class);
$text = 'Some text with @placeholders or anything {else}';
if ($parser->canParse($text)) {
    echo $parser->parse($text);
}
```