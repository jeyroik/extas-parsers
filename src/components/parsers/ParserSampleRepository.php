<?php
namespace extas\components\parsers;

use extas\components\repositories\Repository;
use extas\interfaces\parsers\IParserSampleRepository;

/**
 * Class ParserSampleRepository
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserSampleRepository extends Repository implements IParserSampleRepository
{
    protected string $name = 'parsers_samples';
    protected string $scope = 'extas';
    protected string $pk = ParserSample::FIELD__NAME;
    protected string $itemClass = ParserSample::class;
}
