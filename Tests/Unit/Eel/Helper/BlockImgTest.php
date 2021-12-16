<?php
namespace Sandstorm\PublicWebsite\Tests\Unit;

use Neos\Flow\Tests\UnitTestCase;
use Neos\Utility\ObjectAccess;
use Sandstorm\CookiePunch\Eel\Helper\CookiePunch;

/**
 * Testcase
 */
class BlockImgTest extends UnitTestCase
{
    /**
     * @test
     */
    public function singleAudioTag() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<img src="someimage.png"/>';
        $expected =
            '<img data-src="someimage.png"/>';
        $actual = $blockExternalContentHelper->blockTag("img", $markup);
        self::assertEquals($expected, $actual);
    }
}