<?php
namespace extas\components\parsers;

use extas\components\Item;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserDateTime
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserCurrentDateTime extends Item implements IParseDispatcher
{
    public const FIELD__PATTERN = 'pattern';

    /**
     * @param mixed $value
     * @return string|string[]|null
     */
    public function __invoke($value)
    {
        if (is_string($value)) {
            $pattern = $this->getPattern();

            preg_match($pattern, $value, $matches);
            if (!empty($matches)) {
                $dateFormat = array_pop($matches);
                return preg_replace($pattern, date($dateFormat), $value);
            }
            return $value;
        } elseif (is_array($value)) {
            foreach ($value as $index => $subValue) {
                $value[$index] = $this->__invoke($subValue);
            }
            return $value;
        }

        return $value;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->config[static::FIELD__PATTERN] ?? '';
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.parser.datetime';
    }
}
