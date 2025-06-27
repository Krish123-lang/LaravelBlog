<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-3 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    <h1 class="text-2xl mb-4">{{$post->title}}</h1>
                    <div class="flex gap-4">
                        @if ($post->user->image)
                            <img src="{{$post->user->imageUrl()}}" alt="{{$post->user->name}}" class="w-12 h-12 rounded-full">
                        @else
                            <img src="https://static.everypixel.com/ep-pixabay/0329/8099/0858/84037/3298099085884037069-head.png" alt="Dummy Avatar" class="w-12 h-12 rounded-full">
                        @endif

                        <div>
                            <div class="flex gap-2">
                                <h3>{{$post->user->name}}</h3>
                                &middot;
                                <a href="#" class="text-emerald-600">Follow</a>
                            </div>
                            <div class="flex ga-2 text-sm text-gray-500">
                                {{$post->readTime()}} min read
                                &middot;
                                {{$post->created_at->format('M d,Y')}}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mt-4"></div> --}}

                    <x-clap />

                    <div class="mt-8">
                        <img src="{{$post->imageUrl()}}" alt="{{$post->title}}" class="w-full">

                        <div class="mt-4">
                            <p>{{$post->content}}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <span class="px-4 py-2 bg-gray-200 rounded-2xl">
                            {{$post->category->name}}
                        </span>
                    </div>

                    <x-clap />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
