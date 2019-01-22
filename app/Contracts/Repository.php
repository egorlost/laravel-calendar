<?php

namespace App\Contracts;

/**
 * Interface Repository
 */
interface Repository
{
    /**
     * Update data
     *
     * @param $id
     * @param $inputs
     */
    public function update($id, array $inputs);

    /**
     * Store data
     *
     * @param $inputs
     */
    public function store(array $inputs);

    /**
     * Destroy data
     *
     * @param $id
     */
    public function destroy($id);

    /**
     * Find data
     *
     * @param $id
     */
    public function find($id);
}
