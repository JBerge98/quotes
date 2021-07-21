<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 */

namespace PhpOffice\PhpPresentation\Tests\Shape\RichText;

use PhpOffice\PhpPresentation\Shape\RichText\Run;
use PhpOffice\PhpPresentation\Style\Font;
use PHPUnit\Framework\TestCase;

/**
 * Test class for Run element.
 *
 * @coversDefaultClass \PhpOffice\PhpPresentation\Shape\RichText\Run
 */
class RunTest extends TestCase
{
    /**
     * Test can read.
     */
    public function testConstruct(): void
    {
        $object = new Run();
        $this->assertEquals('', $object->getText());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Style\\Font', $object->getFont());

        $object = new Run('BBB');
        $this->assertEquals('BBB', $object->getText());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Style\\Font', $object->getFont());
    }

    public function testFont(): void
    {
        $object = new Run();
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\RichText\\Run', $object->setFont(new Font()));
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Style\\Font', $object->getFont());
    }

    public function testLanguage(): void
    {
        $object = new Run();
        $this->assertNull($object->getLanguage());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\RichText\\Run', $object->setLanguage('en-US'));
        $this->assertEquals('en-US', $object->getLanguage());
    }

    public function testText(): void
    {
        $object = new Run();
        $this->assertEquals('', $object->getText());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\RichText\\Run', $object->setText());
        $this->assertEquals('', $object->getText());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\RichText\\Run', $object->setText('AAA'));
        $this->assertEquals('AAA', $object->getText());

        $object = new Run('BBB');
        $this->assertEquals('BBB', $object->getText());
    }

    /**
     * Test get/set hash index.
     */
    public function testHashCode(): void
    {
        $object = new Run();
        $this->assertEquals(md5($object->getFont()->getHashCode() . get_class($object)), $object->getHashCode());
    }
}
