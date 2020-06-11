<?php
namespace extas\components\plugins\install;

use extas\components\parsers\Parser;

/**
 * Class InstallParsers
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallParsers extends InstallSection
{
    protected string $selfSection = 'parsers';
    protected string $selfName = 'parser';
    protected string $selfRepositoryClass = 'parserRepository';
    protected string $selfUID = Parser::FIELD__NAME;
    protected string $selfItemClass = Parser::class;
}
