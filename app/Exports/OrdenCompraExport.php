<?php

namespace App\Exports;

use App\Models\DetalleCompra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdenCompraExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public $id_compra;

    public function __construct($id_compra)
    {
        $this->id_compra = $id_compra;
    }

    public function headings(): array
    {
        return [
            'codigo_detalle', 'producto', 'cantidad', 'precio'
        ];
    }


    public function collection()
    {
        return DetalleCompra::select('detalle_compras.id', 'productos.nombre', 'detalle_compras.cantidad', 'detalle_compras.precio')
                            ->join('productos', 'detalle_compras.id_producto', 'productos.id')
                            ->where('id_compra', $this->id_compra)
                            ->get();
    }
}
