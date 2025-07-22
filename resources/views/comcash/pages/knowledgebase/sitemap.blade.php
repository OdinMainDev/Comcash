@extends('comcash.layout.main')
@section('content')

<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <h1 class="text-left text-[#06AB6B] max-[500px]:text-[24px] font-bold text-[32px] mb-8">Карта сайта</h1>
    @php
        $chunks = collect($directions)->chunk(7 * 3); 
    @endphp

    <div class="flex gap-10">
        <div class="flex flex-col space-y-10 text-white text-sm w-full">
            @foreach($chunks as $chunk)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
                    @foreach($chunk as $direction)
                        <a href="{{ route('exchgangePage', [$direction->currencyFrom->name, $direction->currencyTo->name]) }}" class="underline">
                            {{ $direction->currencyFrom->name }} → {{ $direction->currencyTo->name }}
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

</section>

@endsection