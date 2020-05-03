<?php
namespace tests\parsers;

use extas\components\conditions\Condition;
use extas\components\conditions\ConditionEqual;
use extas\components\conditions\ConditionRepository;
use extas\components\parsers\Parser;
use extas\components\parsers\ParserCurrentDateTime;
use extas\components\parsers\ParserNullValue;
use extas\components\parsers\ParserOneOf;
use extas\components\parsers\ParserSample;
use extas\components\parsers\ParserSimpleReplace;
use extas\components\SystemContainer;
use extas\interfaces\conditions\IConditionRepository;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\samples\parameters\ISampleParameter;
use PHPUnit\Framework\TestCase;
use tests\ParserIsOk;

/**
 * Class ParserTest
 *
 * @package tests\parsers
 * @author jeyroik@gmail.com
 */
class ParserTest extends TestCase
{
    protected ?IRepository $condRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->condRepo = new ConditionRepository();

        SystemContainer::addItem(
            IConditionRepository::class,
            ConditionRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->condRepo->delete([Condition::FIELD__NAME => 'eq']);
    }

    public function testCanParse()
    {
        $parser = new Parser([
            Parser::FIELD__VALUE => '@test',
            Parser::FIELD__CONDITION => '='
        ]);

        $this->condRepo->create(new Condition([
            Condition::FIELD__NAME => 'eq',
            Condition::FIELD__CLASS => ConditionEqual::class,
            Condition::FIELD__ALIASES => ['eq', '=']
        ]));

        $this->assertTrue($parser->canParse('@test'), 'Can not parse @test');
    }

    public function testParse()
    {
        $parser = new Parser([
            Parser::FIELD__VALUE => '@test',
            Parser::FIELD__CONDITION => '=',
            Parser::FIELD__CLASS => ParserIsOk::class
        ]);

        $this->assertEquals('is ok', $parser->parse('@test'));
    }

    public function testNullValue()
    {
        $parser = new Parser([
            Parser::FIELD__CLASS => ParserNullValue::class
        ]);

        $this->assertEquals(null, $parser->parse('@null'));
    }

    public function testCurrentDateTime()
    {
        $parser = new Parser([
            Parser::FIELD__CLASS => ParserCurrentDateTime::class,
            Parser::FIELD__PARAMETERS => [
                ParserCurrentDateTime::FIELD__PATTERN => [
                    ISampleParameter::FIELD__NAME => ParserCurrentDateTime::FIELD__PATTERN,
                    ISampleParameter::FIELD__VALUE => '/\@date\((.*?)\)/m'
                ]
            ]
        ]);

        $this->assertEquals(
            'Now is ' . date('Y-m-d'),
            $parser->parse('Now is @date(Y-m-d)')
        );

        $this->assertEquals(
            [
                'Now is ' . date('Y-m-d'),
                'Now is ' . date('Y/m/d'),
            ],
            $parser->parse(['Now is @date(Y-m-d)', 'Now is @date(Y/m/d)'])
        );

        $this->assertEquals(
            'Now is not a date@',
            $parser->parse('Now is not a date@')
        );

        $this->assertEquals($parser, $parser->parse($parser));
    }

    public function testSimpleReplace()
    {
        $parser = new Parser([
            Parser::FIELD__CLASS => ParserSimpleReplace::class,
            Parser::FIELD__PARAMETERS => [
                ParserSimpleReplace::FIELD__PARAM_NAME => [
                    ISampleParameter::FIELD__NAME => ParserSimpleReplace::FIELD__PARAM_NAME,
                    ISampleParameter::FIELD__VALUE => 'test'
                ]
            ],
            'test' => [
                'status' => 'is ok'
            ]
        ]);

        $this->assertEquals(
            'Test is ok',
            $parser->parse('Test @test.status')
        );

        $parser->setParameterValue(ParserSimpleReplace::FIELD__PARAM_NAME, 'unknown');
        $this->assertEquals(
            'Test @test.status',
            $parser->parse('Test @test.status')
        );
    }

    public function testOneOf()
    {
        $parser = new Parser([
            Parser::FIELD__CLASS => ParserOneOf::class,
            Parser::FIELD__PARAMETERS => []
        ]);

        $this->assertTrue(
            in_array(
                $parser->parse('test is @oneof("smile", "is ok", "\"working\"")'),
                ['test is smile', 'test is ok', 'test is "working"']
            )
        );

        $this->assertEquals(
            'Test @test.status',
            $parser->parse('Test @test.status')
        );
    }

    public function testSample()
    {
        $sample = new ParserSample();
        $this->assertTrue($sample instanceof ParserSample);
    }
}
