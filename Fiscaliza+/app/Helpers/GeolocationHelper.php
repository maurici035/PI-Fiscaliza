<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GeolocationHelper
{
    public static function obterEnderecoPorCoordenadas($latitude, $longitude)
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Fiscaliza/1.0 (ficalizamais@gmail.com)'
        ])->get("https://nominatim.openstreetmap.org/reverse", [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json',
            'addressdetails' => 1,
        ]);

        if ($response->successful()) {
        $data = $response->json();

        if (isset($data['address'])) {
            $address = $data['address'];
            // Exemplos de campos: road, neighbourhood, suburb, city, town, state, country

            // Montar um endereço resumido
            $partes = [];

            if (isset($address['road'])) {
                $partes[] = $address['road'];
            } elseif (isset($address['pedestrian'])) {
                $partes[] = $address['pedestrian'];
            }

            if (isset($address['neighbourhood'])) {
                $partes[] = $address['neighbourhood'];
            } elseif (isset($address['suburb'])) {
                $partes[] = $address['suburb'];
            }

            if (isset($address['city'])) {
                $partes[] = $address['city'];
            } elseif (isset($address['town'])) {
                $partes[] = $address['town'];
            } elseif (isset($address['village'])) {
                $partes[] = $address['village'];
            }

            if (isset($address['state'])) {
                $partes[] = $address['state'];
            }

            return implode(', ', $partes);
        }

        // fallback para display_name, se quiser mostrar completo
        if (isset($data['display_name'])) {
            return $data['display_name'];
        }
    }

        return 'Local não encontrado';
    }
}
