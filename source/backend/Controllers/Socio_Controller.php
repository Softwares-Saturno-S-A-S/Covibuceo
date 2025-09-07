<?php
    require_once '../models/Socio.php'; // Incluye el modelo Socio

    Class Socio_Controller {
        private $Socio;

        public function __construct() {
            $this->Socio = new Socio();
        }

        public function agregar_Socio($input) {
            if ($this->Socio->verify_existente($input)) { // Verifica si el socio ya existe
                return [
                    'status' => 409,
                    'error' => 'Ya existe un usuario con esta cédula y/o el E-mail.'
                ];
            } elseif ($this->Socio->verify_solicitud($input)) { // Verifica si el socio ya tiene una solicitud pendiente
                return [
                    'status' => 410,
                    'error' => 'Ya ha enviado una solicitud con esta cédula y/o el E-mail.'
                ];
            } else {
                if ($this->Socio->add_Socio($input)){
                    return [
                            'status' => 201,
                            'mensaje' => 'Solicitud enviada',
                            'email' => $input['email']
                        ];
                    } else { // Si la inserccion no fue exitosa, por error de conexión, devuelve el status 500 y un mensaje de error
                        return [
                            'status' => 500,
                            'error' => 'Error al registrar solicitud: ' . $this->Socio->add_Socio($input)
                        ];
                }
            } 
        }
    }
?>