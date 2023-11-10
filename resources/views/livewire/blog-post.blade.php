<div>
    <div class="container mx-auto p-4 mt-[50px]">
        <div class="max-w-[75rem] w-full mx-auto items-center">
            <div class="flex flex-col items-center justify-center p-4">
                <h3 class="mb-6 text-[2.5rem] font-bold">{{ $this->post->title }}</h3>
                <figure class="max-w-[45rem]">
                    <img class="h-auto max-w-full rounded-lg" src="{{ url('storage/'.$this->post->thumbnail)}}" alt="">
                </figure>
                <div class="mt-5 prose max-w-[55rem]">
                    {!! $this->post->content !!}
                </div>
            </div>
        </div>
    </div>
</div>