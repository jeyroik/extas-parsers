<?php
namespace extas\components\parsers;

use extas\components\Item;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserOneOfReplace
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserOneOf extends Item implements IParseDispatcher
{
    public const FIELD__PATTERN = 'pattern';
    public const FIELD__DELIMITER = 'delimiter';

    /**
     * @param mixed $value
     * @return mixed|string|string[]
     */
    public function __invoke($value)
    {
        if ($this->hasPattern($value, $this->getPattern())) {
            $variants = $this->buildVariants(
                $this->getMatches($value, $this->getPattern()),
                $this->getDelimiter()
            );
            $rand = mt_rand(0, count($variants)-1);
            return preg_replace($this->getPattern(), $variants[$rand], $value);
        }

        return $value;
    }

    /**
     * @param string $listOfVariants
     * @param string $delimiter
     * @return array
     */
    protected function buildVariants(string $listOfVariants, string $delimiter): array
    {
        $list = explode($delimiter, $listOfVariants);
        foreach ($list as $i => $v) {
            $list[$i] = trim(trim($v), '"');
        }

        return $list;
    }

    /**
     * @param $value
     * @param $pattern
     * @return string
     */
    protected function getMatches($value, $pattern): string
    {
        preg_match($pattern, $value, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param $value
     * @param $pattern
     * @return bool
     */
    protected function hasPattern($value, $pattern): bool
    {
        preg_match($pattern, $value, $matches);

        return !empty($matches);
    }

    /**
     * @return string
     */
    protected function getPattern(): string
    {
        return $this->config[static::FIELD__PATTERN] ?? '/\@oneof\((.*)\)/';
    }

    /**
     * @return string
     */
    protected function getDelimiter(): string
    {
        return $this->config[static::FIELD__DELIMITER] ?? ',';
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.parser.one.of.replace';
    }
}
