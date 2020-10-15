<?php

namespace App\Repositories;

use App\Models\Operations;
use App\Repositories\BaseRepository;

/**
 * Class OperationsRepository
 * @package App\Repositories
 * @version October 15, 2020, 5:05 pm UTC
*/

class OperationsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'NomEntreprise',
        'TypeOperation',
        'Montant',
        'Solde',
        'DateOperation',
        'numeroCompte_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Operations::class;
    }
}
