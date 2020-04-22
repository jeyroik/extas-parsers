<?php
namespace extas\components\parsers;

use extas\components\conditions\THasCondition;
use extas\components\samples\Sample;
use extas\components\THasClass;
use extas\components\THasValue;
use extas\interfaces\parsers\IParserSample;

/**
 * Class ParserSample
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserSample extends Sample implements IParserSample
{
    use THasCondition;
    use THasValue;
    use THasClass;

    /**
     * @param array|string $value
     * @return bool
     * @throws \Exception
     */
    public function canParse($value): bool
    {
        return $this->isConditionTrue($value);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.parser.sample';
    }
}
