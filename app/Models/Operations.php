<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Operations
 * @package App\Models
 * @version October 15, 2020, 5:05 pm UTC
 *
 * @property string $NomEntreprise
 * @property string $TypeOperation
 * @property number $Montant
 * @property number $Solde
 * @property string $DateOperation
 * @property integer $numeroCompte_id
 */
class Operations extends Model
{
    use SoftDeletes;

    public $table = 'operations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'NomEntreprise',
        'TypeOperation',
        'Montant',
        'Solde',
        'DateOperation',
        'numeroCompte_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'NomEntreprise' => 'string',
        'TypeOperation' => 'string',
        'Montant' => 'decimal:2',
        'Solde' => 'decimal:2',
        'DateOperation' => 'date',
        'numeroCompte_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NomEntreprise' => 'required',
        'TypeOperation' => 'required',
        'Montant' => 'required',
        'Solde' => 'required',
        'DateOperation' => 'required',
        'numeroCompte_id' => 'required'
    ];

    
}
