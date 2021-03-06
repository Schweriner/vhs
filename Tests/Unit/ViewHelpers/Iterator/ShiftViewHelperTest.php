<?php
namespace FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\Iterator;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\AbstractViewHelperTest;

/**
 * Class ShiftViewHelperTest
 */
class ShiftViewHelperTest extends AbstractViewHelperTest
{

    /**
     * @test
     * @dataProvider getRenderTestValues
     * @param array $arguments
     * @param mixed $expectedValue
     */
    public function testRender(array $arguments, $expectedValue)
    {
        if (true === isset($arguments['as'])) {
            $value = $this->executeViewHelperUsingTagContent('ObjectAccessor', 'variable', $arguments);
        } else {
            $value = $this->executeViewHelper($arguments);
            $value2 = $this->executeViewHelperUsingTagContent('ObjectAccessor', 'v', [], ['v' => $arguments['subject']]);
            $this->assertEquals($value, $value2);
        }
        $this->assertEquals($value, $expectedValue);
    }

    /**
     * @return array
     */
    public function getRenderTestValues()
    {
        return [
            [['subject' => []], null],
            [['subject' => ['foo', 'bar']], 'foo'],
            [['subject' => ['foo', 'bar'], 'as' => 'variable'], 'foo'],
            [['subject' => new \ArrayIterator(['foo', 'bar'])], 'foo'],
            [['subject' => new \ArrayIterator(['foo', 'bar']), 'as' => 'variable'], 'foo'],
        ];
    }

    /**
     * @test
     * @dataProvider getErrorTestValues
     * @param mixed $subject
     */
    public function testThrowsErrorsOnInvalidSubjectType($subject)
    {
        $this->expectViewHelperException('Unsupported input type; cannot convert to array!');
        $this->executeViewHelper(['subject' => $subject]);
    }

    /**
     * @return array
     */
    public function getErrorTestValues()
    {
        return [
            [0],
            [null],
            [new \DateTime()],
            [new \stdClass()],
        ];
    }
}
