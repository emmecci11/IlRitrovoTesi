<?php

namespace Controller;

class CFrontController
{
    public function run($richiestaUrl)
    {
        // Pulizia iniziale della URL
        $richiestaUrl = trim($richiestaUrl, '/');
        $partiUrl = explode('/', $richiestaUrl);

        // Salta le parti fisse del path (es. IlRitrovo/public/)
        // Adatta in base al tuo ambiente, es: /IlRitrovo/public/User/showHomePage
        // Index 0: "IlRitrovo", 1: "public", 2: "User", 3: "showHomePage"
        $controller = ucfirst($partiUrl[2] ?? 'User');
        $metodo = $partiUrl[3] ?? 'showHomePage';

        $parametri = array_slice($partiUrl, 4);

        // Costruzione del nome completo della classe
        $controllerClass = 'Controller\\C' . $controller;

        if (class_exists($controllerClass)) {
            $istanza = new $controllerClass();

            if (method_exists($istanza, $metodo)) {
                call_user_func_array([$istanza, $metodo], $parametri);
            } else {
                http_response_code(404);
                echo "Metodo '$metodo' non esiste nella classe $controllerClass.";
            }
        } else {
            http_response_code(404);
            echo "Classe controller '$controllerClass' non trovata.";
        }
    }
}
