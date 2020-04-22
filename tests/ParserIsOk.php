<?php
namespace tests;

use extas\components\Item;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserIsOk
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class ParserIsOk extends Item implements IParseDispatcher
{
    /**
     * @param mixed $value
     * @return mixed|string
     */
    public function __invoke($value)
    {
        return 'is ok';
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return '';
    }
}