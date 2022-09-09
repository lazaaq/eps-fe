<?php
if (! function_exists('comCd')) {
    function comValue($id){
        $comCodeName = App\Models\Komponen::where('com_cd', $id)->first();
        return $comCodeName->code_value;
    }
}
