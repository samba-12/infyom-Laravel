<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entreprise
 * @package App\Models
 * @version October 15, 2020, 12:08 pm UTC
 *
 * @property string $NomEntreprise
 * @property string $adresse
 * @property string $email
 * @property integer $telephone
 * @property integer $ninea
 */
class Entreprise extends Model
{
    use SoftDeletes;

    public $table = 'entreprises';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'NomEntreprise',
        'adresse',
        'email',
        'telephone',
        'ninea'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'NomEntreprise' => 'string',
        'adresse' => 'string',
        'email' => 'string',
        'telephone' => 'integer',
        'ninea' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NomEntreprise' => 'required',
        'adresse' => 'required',
        'email' => 'required',
        'telephone' => 'required',
        'ninea' => 'required'
    ];

    
}
