<?php
namespace FilmTools\HttpApi;

class JsonDeveloping implements \JsonSerializable
{

    public $N = null;
    public $offset = null;
    public $densities = array();
    public $zones = array();


    /**
     * @param array $densities
     */
    public function setDensities( array $densities )
    {
        $this->densities = $densities;
        return $this;
    }


    /**
     * @return array
     */
    public function getDensities()
    {
        return $this->densities;
    }




    /**
     * @param array $zones
     */
    public function setZones( array $zones )
    {
        $this->zones = $zones;
        return $this;
    }

    /**
     * @return array
     */
    public function getZones()
    {
        return $this->zones;
    }


    /**
     * @param mixed $N
     */
    public function setN( $N )
    {
        $this->N = (float) $N;
        return $this;
    }

    /**
     * @return float
     */
    public function getN()
    {
        return $this->N;
    }


    /**
     * @param mixed $offset
     */
    public function setOffset( $offset )
    {
        $this->offset = (float) $offset;
        return $this;
    }

    /**
     * @return float
     */
    public function getOffset()
    {
        return $this->offset;
    }



    /**
     * @return string
     */
    public function getDevelopingType()
    {
        $N = $this->getN();

        if ($N < 0):
            return 'pull';
        elseif ($N > 0):
            return 'push';
        endif;
        return 'normal';
    }


    public function jsonSerialize()
    {
        return array(
            'zones'      => $this->getZones(),
            'densities'  => $this->getDensities(),
            'N'          => $this->getN(),
            'offset'     => $this->getOffset(),
            'developing' => $this->getDevelopingType()
        );
    }
}
