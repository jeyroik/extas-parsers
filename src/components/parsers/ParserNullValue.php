<?php
namespace extas\components\parsers;

use extas\components\Item;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserNullValue
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserNullValue extends Item implements IParseDispatcher
{
    /**
     * @param mixed $value
     * @return mixed|null
     */
    public function __invoke($value)
    {
        return $value == '@null' ? null : $value;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.parser.null';
    }
}
