<?php
namespace FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\Variable;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Vhs\Tests\Unit\ViewHelpers\AbstractViewHelperTest;

/**
 * Class UnsetViewHelperTest
 */
class UnsetViewHelperTest extends AbstractViewHelperTest
{

    /**
     * @test
     */
    public function canUnsetVariable()
    {
        $variables = new \ArrayObject(['test' => true]);
        $this->executeViewHelper(['name' => 'test'], $variables);
        $this->assertNotContains('test', $variables);
    }
}
