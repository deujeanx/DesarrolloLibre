<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Pasajeros</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-5xl mx-auto my-10 bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">
            Registrar pasajeros para el vuelo #{{ $flight->id }}
        </h1>

        {{-- Mostrar mensajes de éxito --}}
        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                <strong>Ocurrieron algunos errores:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('user_passengers.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            <div id="form-container"></div>

            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition">
                Registrar Pasajeros
            </button>
        </form>
    </div>

    <script>
        const cantidadPasajeros = {{ $cantidad }};
        const contenedor = document.getElementById('form-container');

        for (let i = 1; i <= cantidadPasajeros; i++) {
            const div = document.createElement('div');
            div.classList.add('p-4', 'border', 'border-gray-200', 'rounded-lg', 'mb-4');

            div.innerHTML = `
                <h2 class="font-semibold text-blue-600 mb-3">Pasajero ${i}</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Primer nombre</label>
                        <input type="text" name="passengers[${i}][first_name]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Segundo nombre</label>
                        <input type="text" name="passengers[${i}][middle_name]" class="w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Primer apellido</label>
                        <input type="text" name="passengers[${i}][first_surname]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Segundo apellido</label>
                        <input type="text" name="passengers[${i}][middle_surname]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Fecha de nacimiento</label>
                        <input type="date" name="passengers[${i}][fecha_nacimiento]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Género</label>
                        <select name="passengers[${i}][genero]" class="w-full border-gray-300 rounded-md" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Tipo documento</label>
                        <select name="passengers[${i}][type_document]" class="w-full border-gray-300 rounded-md" required>
                            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Registro Civil">Registro Civil</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Número documento</label>
                        <input type="text" name="passengers[${i}][number_document]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Teléfono</label>
                        <input type="text" name="passengers[${i}][number_phone]" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="passengers[${i}][email]" class="w-full border-gray-300 rounded-md">
                    </div>
                </div>
            `;

            contenedor.appendChild(div);
        }
    </script>
</body>
</html>
