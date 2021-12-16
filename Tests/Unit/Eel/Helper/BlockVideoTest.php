<?php
namespace Sandstorm\PublicWebsite\Tests\Unit;

use Neos\Flow\Tests\UnitTestCase;
use Neos\Utility\ObjectAccess;
use Sandstorm\CookiePunch\Eel\Helper\CookiePunch;

/**
 * Testcase
 */
class BlockVideoTest extends UnitTestCase
{
    /**
     * @test
     */
    public function singleVideoTag() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<video src="some.mp3"></video>';
        $expected =
            '<video data-src="some.mp3"></video>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        self::assertEquals($expected, $actual);

        $markup = '<video src="some.mp3"/>';
        $expected =
            '<video data-src="some.mp3"/>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function singleVideoTagWithType() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<video src="some.mp3" type="video/mp4"></video>';
        $expected =
            '<video data-src="some.mp3" type="video/mp4" data-type="video/mp4"></video>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        self::assertEquals($expected, $actual);

        $markup = '<video src="some.mp3" type="video/mp4"/>';
        $expected =
            '<video data-src="some.mp3" type="video/mp4" data-type="video/mp4"/>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function videoTagWithSource() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<video><source src="some.mp3"/><source src="some.mp3"/></video>';
        $expected =
            '<video><source data-src="some.mp3"/><source data-src="some.mp3"/></video>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        $actual = $blockExternalContentHelper->blockTag("source", $actual);
        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function videoTagWithSourceAndType() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<video><source src="some.mp3" type="video/mp4"/><source src="some.mp3" type="video/mp4"/></video>';
        $expected =
            '<video><source data-src="some.mp3" type="video/mp4" data-type="video/mp4"/><source data-src="some.mp3" type="video/mp4" data-type="video/mp4"/></video>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        $actual = $blockExternalContentHelper->blockTag("source", $actual);
        self::assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function videoTagWithSourceTypeAndTrack() {
        $blockExternalContentHelper = new CookiePunch();

        $markup = '<video><source src="some.mp3" type="video/mp4"/><track src="foo.vtt"/></video>';
        $expected =
            '<video><source data-src="some.mp3" type="video/mp4" data-type="video/mp4"/><track data-src="foo.vtt"/></video>';
        $actual = $blockExternalContentHelper->blockTag("video", $markup);
        $actual = $blockExternalContentHelper->blockTag("source", $actual);
        $actual = $blockExternalContentHelper->blockTag("track", $actual);
        self::assertEquals($expected, $actual);
    }
}
