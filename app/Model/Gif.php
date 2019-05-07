<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 * @property string $title
 * @property string $url
 * @property string $height
 * @property string $width
 */
class Gif extends Model{

    /**
     * Massive fill attributes
     *
     * @var array
     */
    protected $fillable  = array('title', 'url', 'height', 'width');
}
?>