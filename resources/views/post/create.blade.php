<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-3 lg:px-8">
            <h1 class="text-2xl font-medium mb-4">Create Post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Text --}}
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Category --}}
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select a category</option>

                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @selected(old('category_id')==$category->id)>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        {{-- Content --}}
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Content')" />
                            <x-text-inputarea id="content" class="block mt-1 w-full"  name="content" id="content"  autofocus > {{-- :value="old('content')" --}} {{old('content')}}</x-text-inputarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>


                        {{-- Image --}}
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="file_input" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="image" :value="old('image')" autofocus />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px, 2MB).</p>
                        </div>

                        {{-- Published At --}}
                        <div class="mt-4">
                            <x-input-label for="published_at" :value="__('Published At')" />
                            <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local" name="published_at" :value="old('published_at')" autofocus />
                            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
