<?php 
namespace App\Http\Controllers\laravelmenu\src\Facades;
use Illuminate\Support\Facades\Facade;

class Menu extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'harimayco-menu';
    }
}