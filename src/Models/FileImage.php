<?php
/**
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @datetime 2017-05-22 20:30
 */

namespace Notadd\ImagesManager\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FileImage extends Model
{
    use SoftDeletes;
    const USED=1;
    const UNUSED=2;
}