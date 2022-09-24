@extends('layouts.app')
@section('page-title')
    Policies |
@endsection
@section('content')
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 5.8rem;">
        <div class="container py-4">
            <div class="row">
                <div class="col">
                    <h1>Política de Cookies</h1>
                    <h2>¿Qué son las cookies?</h2>
                    <p>
                        Las cookies son pequeños archivos de texto que los sitios web instalan en el ordenador o dispositivo
                        móvil de los usuarios que los visitan.
                    </p>
                    <p>
                        Las cookies de origen son aquellas que genera el sitio web que estás visitando y que solo puede leer
                        ese
                        sitio web. Además, un sitio web también puede utilizar servicios externos, que generan sus propias
                        cookies: las cookies de terceros.
                    </p>
                    <p>
                        Las cookies persistentes son las que se guardan en tu ordenador y no se eliminan automáticamente
                        cuando
                        sales del navegador (a diferencia de las cookies de sesión, que sí se eliminan al salir del
                        navegador).
                    </p>
                    <p>
                        Cada vez que visites una web de la Comisión, se te pedirá que aceptes o rechaces las cookies.
                    </p>
                    <p>
                        La finalidad es recordar tus preferencias (nombre de usuario, idioma, etc.) durante un período de
                        tiempo
                        determinado.
                    </p>
                    <p>
                        Así, no tienes que volver a indicarlas al navegar por nuestras páginas durante una misma visita.
                    </p>
                    <p>
                        Las cookies también pueden utilizarse para elaborar estadísticas anonimizadas sobre la experiencia
                        de
                        navegación en nuestros sitios web.
                    </p>
                    <h2>
                        ¿Cómo utilizamos las cookies?
                    </h2>
                    <p>

                        Los sitios web de la Comisión Europea utilizan en su mayoría «cookies de origen» generadas y
                        controladas
                        por la Comisión, y no por organizaciones externas.
                    </p>
                    <p>

                        No obstante, para ver algunas de nuestras páginas tendrás que aceptar cookies de organizaciones
                        externas.
                    </p>
                    <p>
                        Los tres tipos de cookies de origen que utilizamos nos permiten:
                    </p>
                    <ul>
                        <li>
                            Almacenar las preferencias de los visitantes
                        </li>
                        <li>
                            Mantener en funcionamiento nuestros sitios web
                        </li>
                        <li>
                            Reunir datos de análisis (sobre el comportamiento de los usuarios).
                        </li>
                    </ul>
                    <p>
                        Preferencias de los visitantes
                    </p>
                    <p>
                        Las generamos nosotros y nadie más puede leerlas. Registran:
                    </p>
                    <p>
                        si el visitante ha aceptado (o rechazado) la política de cookies del sitio si ya ha respondido a
                        nuestra
                        encuesta en ventana emergente sobre la utilidad del contenido.
                    </p>
                    <h2>
                        ¿Cómo gestionar las cookies?
                    </h2>
                    <h3>
                        Eliminar las cookies del dispositivo
                    </h3>
                    <p>
                        Puedes eliminar las cookies que ya tengas en tu dispositivo borrando el historial del navegador. De
                        esta
                        manera se suprimirán las cookies de todos los sitios web que hayas visitado.
                    </p>
                    <p>
                        Sin embargo, también podrías perder parte de la información que tengas guardada (por ejemplo, tus
                        identificadores de inicio de sesión o tus preferencias para los sitios web).
                    </p>
                    <p>
                        Gestionar las cookies de un determinado sitio
                    </p>

                    <p>
                        Para tener un control más preciso de las cookies específicas de cada sitio, los usuarios pueden
                        ajustar
                        su configuración de privacidad y cookies en el navegador.
                    </p>
                    <h3>
                        Bloquear las cookies
                    </h3>
                    <p>
                        Es posible configurar la mayoría de los navegadores modernos para que no acepten cookies en el
                        dispositivo que utilizas, pero en ese caso puedes tener que configurar manualmente una serie de
                        preferencias cada vez que visites un sitio o página. Además, algunos servicios y características
                        pueden
                        no funcionar correctamente (por ejemplo, los inicios de sesión con perfil).
                    </p>

                </div>
            </div>
            <!-- BOTONES CATEGORIAS -->
            @include('menus.menu_footer_categories')
            <!-- BOTONES CATEGORIAS -->
        </div>
    </main>
@endsection
