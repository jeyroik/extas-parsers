<?php
namespace extas\components\parsers;

use extas\components\samples\THasSample;
use extas\interfaces\parsers\IParser;

/**
 * Class Parser
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class Parser extends ParserSample implements IParser
{
    use THasSample;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function parse($value)
    {
        $parseDispatcher = $this->buildClassWithParameters($this->getParametersValues());

        return $parseDispatcher($value);
    }

    protected function getSubjectForExtension(): string
    {
        return 'extas.parser';
    }
}
