<?php

namespace App\Contracts;

/**
 * Interface Repository
 */
interface Repository
{
    /**
     * Update method
     *
     * @param $id
     * @param $inputs
     */
    public function update($id, array $inputs);

    /**
     * Store method
     *
     * @param $inputs
     */
    public function store(array $inputs);

    /**
     * Get data array
     *
     * @param $id
     */
    public function destroy($id);

    /**
     * Find method
     *
     * @param $id
     */
    public function find($id);
}
