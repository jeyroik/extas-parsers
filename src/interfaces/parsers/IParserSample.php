<?php
namespace extas\interfaces\parsers;

use extas\interfaces\conditions\IHasCondition;
use extas\interfaces\IHasClass;
use extas\interfaces\samples\ISample;

/**
 * Interface IParserSample
 *
 * @package extas\interfaces\parsers
 * @author jeyroik@gmail.com
 */
interface IParserSample extends ISample, IHasCondition, IHasClass
{
    /**
     * @param string|array $value
     * @return bool
     */
    public function canParse($value): bool;
}
