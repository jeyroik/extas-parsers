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
        $thisData = $this->__toArray();
        unset($thisData[static::FIELD__PARAMETERS]);
        unset($thisData[static::FIELD__CLASS]);
        $params = array_merge($thisData, $this->getParametersValues());
        $parseDispatcher = $this->buildClassWithParameters($params);

        return $parseDispatcher($value);
    }

    protected function getSubjectForExtension(): string
    {
        return 'extas.parser';
    }
}
