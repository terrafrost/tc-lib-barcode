<?php
/**
 * PdfFourOneSevenTest.php
 *
 * @since       2015-02-21
 * @category    Library
 * @package     Barcode
 * @author      Nicola Asuni <info@tecnick.com>
 * @copyright   2015-2015 Nicola Asuni - Tecnick.com LTD
 * @license     http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
 * @link        https://github.com/tecnick.com/tc-lib-barcode
 *
 * This file is part of tc-lib-barcode software library.
 */

namespace Test\Square;

/**
 * Barcode class test
 *
 * @since       2015-02-21
 * @category    Library
 * @package     Barcode
 * @author      Nicola Asuni <info@tecnick.com>
 * @copyright   2015-2015 Nicola Asuni - Tecnick.com LTD
 * @license     http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
 * @link        https://github.com/tecnick.com/tc-lib-barcode
 */
class PdfFourOneSevenTest extends \PHPUnit_Framework_TestCase
{
    protected $obj = null;

    public function setUp()
    {
        //$this->markTestSkipped(); // skip this test
        $this->obj = new \Com\Tecnick\Barcode\Barcode;
    }

    public function testInvalidInput()
    {
        $this->setExpectedException('\Com\Tecnick\Barcode\Exception');
        $this->obj->getBarcodeObj('PDF417', '');
    }

    public function testTooLong()
    {
        $this->setExpectedException('\Com\Tecnick\Barcode\Exception');
        $code = str_pad('', 1000, 'X1');
        $this->obj->getBarcodeObj('PDF417', $code);
    }

    public function testGetGrid()
    {
        $bobj = $this->obj->getBarcodeObj('PDF417', '0123456789');
        $grid = $bobj->getGrid();
        $expected = "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000\n"
            ."000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000\n"
            ."001111111101010100011110101001111000111010100011100001110101011100000011111110100010100100\n"
            ."001111111101010100011110101000010000111110001110110101111110101001110011111110100010100100\n"
            ."001111111101010100011010101111100000111110101111011001010100001111000011111110100010100100\n"
            ."001111111101010100011111010111111010101000111011100001101011110111110011111110100010100100\n"
            ."001111111101010100011010111000001000101000111100000101110101110001100011111110100010100100\n"
            ."001111111101010100011111010111000010111001001111100101111010111110110011111110100010100100\n"
            ."001111111101010100011010011100111100110010000100110001010011101110000011111110100010100100\n"
            ."001111111101010100011111101001011100100110111111011001010111111001110011111110100010100100\n"
            ."001111111101010100010100110111110000100011011101111101111101001110100011111110100010100100\n"
            ."001111111101010100010100011101110000100110001110110001010001100011000011111110100010100100\n"
            ."001111111101010100011010011100001000101111110011011101110100111001100011111110100010100100\n"
            ."001111111101010100011010001001111100100111101110011101111110100011001011111110100010100100\n"
            ."001111111101010100010100000101000000110010111011110001010000110000110011111110100010100100\n"
            ."001111111101010100011110100010000100111110110001010001111010001001000011111110100010100100\n"
            ."001111111101010100011110100001111010110001010111110001010000001001111011111110100010100100\n"
            ."000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000\n"
            ."000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000\n";
        $this->assertEquals($expected, $grid);

        $code = str_pad('', 1750, 'X');
        $bobj = $this->obj->getBarcodeObj('PDF417,2,8,1,0,0,0,1,2', $code);
        $grid = $bobj->getGrid();
        $this->assertEquals('f0874a35e15f11f9aa8bc070a4be24bf', md5($grid));

        $code = str_pad('', 1750, 'X');
        $bobj = $this->obj->getBarcodeObj('PDF417,15,8,1,0,0,0,1,2', $code);
        $grid = $bobj->getGrid();
        $this->assertEquals('0288f0a87cc069fc34d6168d7a9f7846', md5($grid));
    }
}
