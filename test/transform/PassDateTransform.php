<?php
namespace mjburgess\paydays\transform;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-05-29 at 13:52:54.
 */
class PassDateTransformTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers mjburgess\paydays\transform\PassDateTransform::apply
     */
    public function testApply()
    {
        $this->assertEquals(time(), (new PassDateTransform)->apply(time()));
    }
}
