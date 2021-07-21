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
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpPresentation\Shape;

use PhpOffice\PhpPresentation\ComparableInterface;
use PhpOffice\PhpPresentation\Shape\Chart\Legend;
use PhpOffice\PhpPresentation\Shape\Chart\PlotArea;
use PhpOffice\PhpPresentation\Shape\Chart\Title;
use PhpOffice\PhpPresentation\Shape\Chart\View3D;

/**
 * Chart element.
 */
class Chart extends AbstractGraphic implements ComparableInterface
{
    /**
     * Title.
     *
     * @var Title
     */
    private $title;

    /**
     * Legend.
     *
     * @var Legend
     */
    private $legend;

    /**
     * Plot area.
     *
     * @var PlotArea
     */
    private $plotArea;

    /**
     * View 3D.
     *
     * @var View3D
     */
    private $view3D;

    /**
     * Is the spreadsheet included for editing data ?
     *
     * @var bool
     */
    private $includeSpreadsheet = false;

    /**
     * Create a new Chart.
     */
    public function __construct()
    {
        // Initialize
        $this->title = new Title();
        $this->legend = new Legend();
        $this->plotArea = new PlotArea();
        $this->view3D = new View3D();

        // Initialize parent
        parent::__construct();
    }

    public function __clone()
    {
        parent::__clone();

        $this->title = clone $this->title;
        $this->legend = clone $this->legend;
        $this->plotArea = clone $this->plotArea;
        $this->view3D = clone $this->view3D;
    }

    /**
     * Get Title.
     *
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * Get Legend.
     *
     * @return Legend
     */
    public function getLegend(): Legend
    {
        return $this->legend;
    }

    /**
     * Get PlotArea.
     *
     * @return PlotArea
     */
    public function getPlotArea(): PlotArea
    {
        return $this->plotArea;
    }

    /**
     * Get View3D.
     *
     * @return View3D
     */
    public function getView3D(): View3D
    {
        return $this->view3D;
    }

    /**
     * Is the spreadsheet included for editing data ?
     *
     * @return bool
     */
    public function hasIncludedSpreadsheet(): bool
    {
        return $this->includeSpreadsheet;
    }

    /**
     * Is the spreadsheet included for editing data ?
     *
     * @param bool $value
     *
     * @return self
     */
    public function setIncludeSpreadsheet(bool $value = false): self
    {
        $this->includeSpreadsheet = $value;

        return $this;
    }

    /**
     * Get indexed filename (using image index).
     *
     * @return string
     */
    public function getIndexedFilename(): string
    {
        return 'chart' . $this->getImageIndex() . '.xml';
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode(): string
    {
        return md5(parent::getHashCode() . $this->title->getHashCode() . $this->legend->getHashCode() . $this->plotArea->getHashCode() . $this->view3D->getHashCode() . ($this->includeSpreadsheet ? 1 : 0) . __CLASS__);
    }
}
