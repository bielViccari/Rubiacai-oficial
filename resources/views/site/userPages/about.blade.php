<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sobre nós</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex flex-wrap">
        <div class="w-full sm:w-8/12 mb-10">
          <div class="container mx-auto h-full sm:p-10">
            <nav class="flex px-4 justify-between items-center">
              <div class="text-4xl font-bold">
                Delicious<span class="text-purple-700">  açai.</span>
              </div>
              <a href="{{ route('pagina.inicial') }}" class="text-sm text-purple-700 font-semibold">Página Inicial</a>
              <div>
                <img src="https://image.flaticon.com/icons/svg/497/497348.svg" alt="" class="w-8">
              </div>
            </nav>
            <header class="container px-4 lg:flex mt-10 items-center h-full lg:mt-0">
              <div class="w-full">
                <h1 class="text-4xl lg:text-6xl font-bold">Fornecendo o melhor <span class="text-purple-700">açai</span></h1>
                <div class="w-20 h-2 bg-purple-700 my-4"></div>
                <p class="text-xl mb-10">Fundado em 2022, para trazer a cultura do açai para a cidade na intenção de aumentar o comercio da cidade e à variedade de locais para visitar ou comer algo diferente e refrescante como o açai.</p>
                <button class="bg-purple-500 text-white text-2xl font-medium px-4 py-2 rounded shadow hover:bg-purple-600 "><a target="_blank" href="https://www.instagram.com/rubiacai.acai/">Ver mais</a></button>
              </div>
            </header>
          </div>
        </div>
        <img src="images/place.jpg" alt="Leafs" class="w-full h-48 object-cover sm:h-screen sm:w-4/12">
      </div>

      <x-footer />
</body>
</html>