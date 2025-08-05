@extends('comcash.layout.main')


@section('content')

  <div data-form="404">
    <div
    class="absolute top-[-10%] inset-0 bg-[url('/comcash/img/green_mesh.webp')] bg-center bg-no-repeat z-0 pointer-events-none max-[500px]:hidden">
    </div>

    <section
    class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">
    <div class="relative flex items-center justify-center overflow-hidden">
      <div class="relative flex flex-col items-center justify-center text-center px-4 z-10">
      <img src="/comcash/img/404.webp" class="max-w-[460px] max-h-[273px] object-contain" />
      <h2 class="text-[#06AB6B] max-[500px]:text-[24px] text-[32px] font-bold uppercase mt-6">ПРОИЗОШЛА ОШИБКА</h2>
      <p class="text-white max-[500px]:text-[14px] text-[16px] mt-2">Вернитесь на главную страницу</p>
      <div class="flex justify-start mt-2 max-w-[600px] w-full">
        <a href="/"
        class="w-full text-white text-[18px] font-medium rounded-full h-[62px] transition hover:opacity-90 uppercase flex items-center justify-center"
        style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
        На главную
        </a>
      </div>
      </div>
    </div>
    </section>
  </div>

@endsection