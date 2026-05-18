<?php
    class GuardMiddleware {
        //Protege rutas que requieren autenticación (solo pasa el usuario está logueado, sino va al login. Si $request tiene un user válido avanza normalmente. Caso contrario detiene el script y redirige al login.)
        public function run($request) {
            if($request->user) {
                return $request;
            } else {
                header("Location: ".BASE_URL."login");
                exit();
            }
        }
    }
