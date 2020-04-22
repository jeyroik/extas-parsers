<?php
namespace extas\components\plugins;

use extas\components\parsers\ParserSample;
use extas\interfaces\parsers\IParserSampleRepository;

/**
 * Class PluginInstallParsersSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallParsersSamples extends PluginInstallDefault
{
    protected string $selfSection = 'parsers_samples';
    protected string $selfName = 'parser sample';
    protected string $selfRepositoryClass = IParserSampleRepository::class;
    protected string $selfUID = ParserSample::FIELD__NAME;
    protected string $selfItemClass = ParserSample::class;
}
