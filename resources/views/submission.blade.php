<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
  <div class="flex items-center justify-center h-screen">
    <div class="container">
      @foreach($submissions as $key => $submission)
      @if ($loop->last)
      <img src="{{ asset('storage/images/'.$submission) }}" alt="image" class="w-1/2 h-1/2 rounded-full mx-auto">
      @endif
      <div class="p-1">
        <span class="text-gray-500">{{ $key }}</span>
        <span class="text-gray-900">{{ $submission }}</span>
      </div>
      @endforeach
      @if (session('status'))
      <div class="alert alert-success fs-6 text">{{session('status')}}</div>
      @endif
    </div>
</body>

</html>