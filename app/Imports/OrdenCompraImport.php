<?php

namespace App\Imports;

use App\Models\DetalleCompra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrdenCompraImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $detalle_venta_id = $row['codigo_detalle'];

        $detalle = DetalleCompra::where('id', $detalle_venta_id)->first();

        if($detalle) {
            $detalle->precio = $row['precio'];
            $detalle->save();
        }

        return null;
    }
}
