<?php


namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass() : string
    {
        return Model::class;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getForPageListUsers()
    {
        return $this->getInstance()
            ->query()
            ->paginate($this->getPaginateCountUsers());

    }

    /**
     * @return LengthAwarePaginator
     */
    public function getWithPaginate()
    {
        return $this->getInstance()
            ->query()
            ->with('position')
            ->paginate($this->getPaginateCountApiUsers());
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getOneModelForApiShow(int $id)
    {
        return $this->getInstance()
            ->query()
            ->find($id);
    }

    /**
     * @return int
     */
    protected function getPaginateCountUsers(): int
    {
        return config('users.paginate_list_users');
    }

    /**
     * @return int
     */
    public function getPaginateCountApiUsers() : int
    {
        return config('users.api_paginate_list_users');
    }
}
