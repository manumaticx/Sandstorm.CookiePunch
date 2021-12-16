<?php
namespace Sandstorm\PublicWebsite\Tests\Unit;

use Neos\Flow\Tests\UnitTestCase;
use Neos\Utility\ObjectAccess;
use Sandstorm\CookiePunch\Eel\Helper\CookiePunch;

/**
 * Testcase
 */
class BlockIframeTest extends UnitTestCase
{
    /**
     * @test
     */
    public function iframesWillBeBlocked()
    {
        $blockExternalContentHelper = new CookiePunch();

        ObjectAccess::setProperty(
            $blockExternalContentHelper,
            "tagPatterns",
            [
                "iframe" => [
                    "*" => [
                        "service" => "foo",
                    ],
                    "with-style" => [
                        "block" => true,
                    ],
                ],
            ],
            true
        );

        // ### <iframe> with src ###

        $markup = '<iframe src="https://www.w3schools.com"></iframe>';
        $expected =
            '<iframe data-src="https://www.w3schools.com" data-name="foo"></iframe>';
        $actual = $blockExternalContentHelper->blockIframes($markup);

        self::assertEquals($expected, $actual);

        $markup = '<iframe src="with-style"/>';
        $expected =
            '<iframe data-src="with-style" data-name="foo"/>';
        $actual = $blockExternalContentHelper->blockIframes($markup);

        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function tagsWithDataNameWillBeBlocked()
    {
        $blockExternalContentHelper = new CookiePunch();

        $markup =
            '<iframe src="https://www.w3schools.com" data-name="default"></iframe>';
        $expected =
            '<iframe data-src="https://www.w3schools.com" data-name="default"></iframe>';
        $actual = $blockExternalContentHelper->blockIframes($markup);
        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function tagsWillUseServiceNameFromEelHelperAndNotSettings()
    {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<iframe src="https://www.w3schools.com"></iframe>';
        $expected =
            '<iframe data-src="https://www.w3schools.com" data-name="bar"></iframe>';
        $actual = $blockExternalContentHelper->blockIframes(
            $markup,
            true,
            "bar"
        );
        self::assertEquals($expected, $actual);
    }
}