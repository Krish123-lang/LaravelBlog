<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-3 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    <x-category-tabs>
                        No Category found!
                    </x-category-tabs>

                </div>
            </div>

            <div class="text-gray-900 mt-8">
                @forelse ($posts as $post)
                    <x-post-item :post="$post"/>
                @empty
                    <div class="text-center text-gray-400 py-16">No posts found!</div>
                @endforelse
            </div>

            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
