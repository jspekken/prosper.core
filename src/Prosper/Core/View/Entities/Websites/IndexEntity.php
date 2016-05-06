<?php

namespace Prosper\Core\View\Entities\Websites;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\UI\Mappers\Mapper;
use Prosper\Core\View\UI\Controller;

/**
 * Class IndexEntity
 * @package Prosper\Core\View\Entities\Websites
 */
class IndexEntity extends Controller
{

    public function index(Mapper $mapper)
    {
        $mapper->add('layout.grid.row', function ($row) {
            $row->add('layout.grid.column', function ($column) {

                $column->add('content.title', [
                    'text' => 'Website management'
                ]);

            });
        });
    }
}