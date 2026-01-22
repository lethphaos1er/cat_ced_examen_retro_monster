<!DOCTYPE html>
<html lang="fr">
<head>
  @include('template.partials._head')
</head>
<body class="bg-gray-800 text-white font-sans">

  @include('template.partials._header')

  <div class="container mx-auto flex flex-wrap pt-4 pb-12">
    <main class="w-full md:w-3/4 p-4">
      @yield('content')
    </main>

    <aside class="w-full md:w-1/4 p-4">
      @include('template.partials._aside')
    </aside>
  </div>

  @include('template.partials._footer')

  @yield('scripts')
</body>
</html>
