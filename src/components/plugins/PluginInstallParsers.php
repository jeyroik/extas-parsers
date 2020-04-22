<?php
namespace extas\components\plugins;

use extas\components\parsers\Parser;
use extas\interfaces\parsers\IParserRepository;

/**
 * Class PluginInstallParsers
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallParsers extends PluginInstallDefault
{
    protected string $selfSection = 'parsers';
    protected string $selfName = 'parser';
    protected string $selfRepositoryClass = IParserRepository::class;
    protected string $selfUID = Parser::FIELD__NAME;
    protected string $selfItemClass = Parser::class;
}
