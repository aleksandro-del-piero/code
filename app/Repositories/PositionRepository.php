<?php


namespace App\Repositories;
use App\Models\Position as Model;

class PositionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass() : string
    {
        return Model::class;
    }

    public function getListPositionForApi()
    {
        return $this->getInstance()
            ->query()
            ->get();
    }
}
