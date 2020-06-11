<?php
namespace tests\parsers;

use extas\interfaces\samples\parameters\ISampleParameter;

use extas\components\conditions\ConditionRepository;
use extas\components\conditions\TSnuffConditions;
use extas\components\parsers\Parser;
use extas\components\parsers\ParserCurrentDateTime;
use extas\components\parsers\ParserNullValue;
use extas\components\parsers\ParserOneOf;
use extas\components\parsers\ParserSample;
use extas\components\parsers\ParserSimpleReplace;
use extas\components\repositories\TSnuffRepository;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class ParserTest
 *
 * @package tests\parsers
 * @author jeyroik@gmail.com
 */
class ParserTest extends TestCase
{
    use TSnuffRepository;
    use TSnuffConditions;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->registerSnuffRepos([
            'conditionRepository' => ConditionRepository::class
        ]);
    }

    public function tearDown(): void
    {
        $this->unregisterSnuffRepos();
    }

    public function testCanParse()
    {
        $parser = new Parser([
            Parser::FIELD__VALUE => '@test',
            Parser::FIELD__CONDITION => '='
        ]);

        $this->createSnuffCondition('equal');
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
                $parser->parse('test is @oneof(smile,is ok)'),
                ['test is smile', 'test is is ok']
            ),
            'Current result: ' . $parser->parse('test is @oneof(smile,is ok)')
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
