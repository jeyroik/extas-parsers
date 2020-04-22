<?php
namespace extas\interfaces\parsers;

use extas\interfaces\samples\IHasSample;

/**
 * Interface IParser
 *
 * @package extas\interfaces\parsers
 * @author jeyroik@gmail.com
 */
interface IParser extends IParserSample, IHasSample
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function parse($value);
}
