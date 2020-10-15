<?php

namespace App\Repositories;

use App\Models\Entreprise;
use App\Repositories\BaseRepository;

/**
 * Class EntrepriseRepository
 * @package App\Repositories
 * @version October 15, 2020, 12:08 pm UTC
*/

class EntrepriseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'NomEntreprise',
        'adresse',
        'email',
        'telephone',
        'ninea'
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
        return Entreprise::class;
    }
}
