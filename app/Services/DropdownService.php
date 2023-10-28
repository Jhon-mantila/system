<?php

namespace App\Services;

class DropdownService
{
    public function getActive()
    {
        return [
            1 => 'Activo',
            2 => 'Inactivo',
        ];
    }

    public function getTypeDocumento()
    {
        return [
            'cc' => 'Cédula de Ciudadanía.',
            'ti' => 'Tarjeta de identidad.',
            'p' => 'Pasaporte.',
            'ce' => 'Cédula de extranjería.',
        ];
    }

    public function getTypeEmployee()
    {
        return [
            'a' => 'Administrativo.',
            'd' => 'Docente.',
            'i' => 'Instructor.', 
        ];
    }

    public function getTypeCertificate()
    {
        return [
            'c' => 'Certificado.',
            'cm' => 'Constancia Matrícula.',
        ];
    }

    public function getGender()
    {
        return [
            'male' => 'Hombre.',
            'female' => 'Mujer.',
        ];
    }


    // Agrega más métodos para otras listas desplegables
}
