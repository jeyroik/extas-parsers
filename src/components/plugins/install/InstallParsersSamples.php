<?php
namespace extas\components\plugins\install;

use extas\components\parsers\ParserSample;
use extas\interfaces\parsers\IParserSampleRepository;

/**
 * Class InstallParsersSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallParsersSamples extends InstallSection
{
    protected string $selfSection = 'parsers_samples';
    protected string $selfName = 'parser sample';
    protected string $selfRepositoryClass = 'parserSampleRepository';
    protected string $selfUID = ParserSample::FIELD__NAME;
    protected string $selfItemClass = ParserSample::class;
}
