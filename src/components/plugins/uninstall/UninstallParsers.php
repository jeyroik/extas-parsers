<?php
namespace extas\components\plugins\uninstall;

use extas\components\parsers\Parser;

/**
 * Class UninstallParsers
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallParsers extends UninstallSection
{
    protected string $selfSection = 'parsers';
    protected string $selfName = 'parser';
    protected string $selfRepositoryClass = 'parserRepository';
    protected string $selfUID = Parser::FIELD__NAME;
    protected string $selfItemClass = Parser::class;
}
