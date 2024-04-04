<x-layout>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="flex">
        <form action="{{ route('createEntry') }}" method="POST"
              class="flex flex-col gap-4 p-8 rounded-lg shadow-sm bg-white">
            @csrf <!-- CSRF protection -->

            <h1 class="text-2xl font-bold border-b-2 pb-1 border-violet-300">
                Submit an entry
            </h1>

            @if ($errors->any())
            <div class="flex padding-2 rounded bg-red-200">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex flex-col gap-1">
                <div class="flex items-center">
                    <label for="title" class="w-32">Title</label>
                    <input id="title" name="title" type="text" size="60" required class="border p-2">
                </div>

                <div class="flex items-center">
                    <label for="nameInput" class="w-32">Name</label>
                    <input id="nameInput" name="name" type="text" size="60" required class="border p-2">
                </div>

                <div class="flex items-center">
                    <label for="real_name" class="w-32">Real Name</label>
                    <input id="real_name" name="real_name" type="text" size="60" required class="border p-2">
                </div>

                <div class="flex items-center">
                    <label for="emailInput" class="w-32">Email</label>
                    <input id="emailInput" name="email" type="email" size="40" required class="border p-2">
                </div>

                <div class="flex items-start">
                    <label for="contentInput" class="w-32">Content</label>
                    <textarea id="contentInput" name="content" type="text" required
                              class="border p-2 flex flex-1 min-h-[100px]"></textarea>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="p-3 rounded bg-violet-700 text-violet-100 font-bold w-64">Submit</button>
            </div>
        </form>
    </div>
</x-layout>
