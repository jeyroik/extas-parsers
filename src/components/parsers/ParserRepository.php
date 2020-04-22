<?php
namespace extas\components\parsers;

use extas\components\repositories\Repository;
use extas\interfaces\parsers\IParserRepository;

/**
 * Class ParserRepository
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserRepository extends Repository implements IParserRepository
{
    protected string $name = 'parsers';
    protected string $scope = 'extas';
    protected string $pk = Parser::FIELD__NAME;
    protected string $itemClass = Parser::class;
}
