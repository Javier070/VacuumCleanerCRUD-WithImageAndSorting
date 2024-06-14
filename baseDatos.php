

<?php
//Este codigo  que se encarga de establecer la conexión con el servidor de MySQL



    function conectaphp()
    {
        // Se establece la conexión con el servidor de MySQL

        $conex = mysqli_connect(
            '127.0.0.1', // Nombre del servidor
            'root',      // Nombre de usuario
            '',          // Contraseña (en este caso está vacía)
            'aspiradora' // Nombre de la base de datos
         );
        
        //  if ($conex) {
        //     echo "Conexión exitosa";
        //  }
        
        // Retorna el objeto de conexió 
        return $conex;
    }

    // conectaphp(); // vemos si la conexión funciona llamandola 


?> 
 