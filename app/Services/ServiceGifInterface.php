<?php
namespace App\Services;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
interface ServiceGifInterface{

    /**
     * Undocumented function
     *
     * @param string $query
     * @param integer $length
     * @return Collection|static[]
     */
    public function search($query, $length = 25);

    /**
     * Undocumented function
     *
     * @return Gif
     */
    public function random();
}

?>