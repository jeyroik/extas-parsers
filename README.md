![tests](https://github.com/jeyroik/extas-parsers/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-parsers/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>

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