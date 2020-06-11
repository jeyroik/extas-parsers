<?php
namespace extas\components\plugins\uninstall;

use extas\components\parsers\ParserSample;

/**
 * Class UninstallParsersSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallParsersSamples extends UninstallSection
{
    protected string $selfSection = 'parsers_samples';
    protected string $selfName = 'parser sample';
    protected string $selfRepositoryClass = 'parserSampleRepository';
    protected string $selfUID = ParserSample::FIELD__NAME;
    protected string $selfItemClass = ParserSample::class;
}
