<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>
<body>
  <div class="min-h-screen flex items-center justify-center bg-white">
    <form action="{{ route('sendResetEmail') }}" method="POST" class="flex flex-col items-center font-montserrat w-3/12 bg-slate-100 p-8 rounded shadow-lg">
      @csrf
      @if ($errors->any())
        <div class="w-full mb-4 bg-red-100 text-red-700 p-4 rounded">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('invalid_account'))
        <div class="w-full mb-4 bg-red-100 text-red-700 p-4 rounded">
          {{ session('invalid_account') }}
        </div>
      @endif
      <div class="flex flex-col w-full mb-4">
        <label for="" class="mb-2">Masukkan email anda</label>
        <input type="email" name="email" id="email" placeholder="Email" class="p-2 border border-gray-300 rounded" value="{{ old('email') }}">
      </div>
      <button class="bg-slate-300 w-full p-2 rounded ">KIRIM</button>
    </form>
  </div>
</body>
</html>