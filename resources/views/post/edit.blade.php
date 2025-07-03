<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-3 lg:px-8">
            <h1 class="text-2xl font-medium mb-4">Edit Post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- Text --}}
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Category --}}
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select a category</option>

                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @selected(old('category_id', $post->category_id)==$category->id)>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        {{-- Content --}}
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Content')" />
                            <x-text-inputarea id="content" class="block mt-1 w-full"  name="content" id="content"  autofocus>{{ old('content', $post->content) }}</x-text-inputarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="file_input" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="image" :value="old('image')" autofocus />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px, 2MB).</p>
                        </div>

                        {{-- Image --}}
                        @if ($post->imageUrl())
                            <div class="mb-4 mt-3">
                                <img src="{{ $post->imageUrl() }}?t={{ $post->updated_at->timestamp }}" alt="{{ $post->name }}" class="w-40">
                            </div>
                        @else
                            <div class="mb-4" mt-3>
                                <img src="{{ asset('img/placeholder/placeholder.jpg') }}" alt="Placeholder Image" class="w-50 h-50">
                            </div>
                        @endif

                        <div class="mt-4">
                            <x-primary-button>
                                Update
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
