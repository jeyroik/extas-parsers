<?php
namespace extas\interfaces\parsers;

use extas\interfaces\IItem;

/**
 * Interface IParseDispatcher
 *
 * @package extas\interfaces\parsers
 * @author jeyroik@gmail.com
 */
interface IParseDispatcher extends IItem
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function __invoke($value);
}
