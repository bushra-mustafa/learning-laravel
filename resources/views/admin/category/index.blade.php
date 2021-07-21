<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            <b style="float: left"> All Category </b>
            <b style="float: right"> Total Category
                <span class="badge badge-danger">
                    {{ count($categories) }}
                </span></b>
        </h2><br>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                @if (@session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>

                            <button type="button" class="close"
                            data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                @endif


                        <div class="card-header"> All Category </div>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Sl number</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach ($categories as $category )

                                <tr>

                                    <th scope="row"> {{ $i++ }} </th>

                                    <td>{{$category->category_name  }}</td>
                                    <td>{{  $category->user_id}}</td>
                                    {{-- =Auth::user()->id --}}
                                    <td> @if ($category->created_at== Null)
                                    <span class="text-danger"> NOT DATA SET </span>
                                    @else
                                    {{Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Category </div>
                        <form action=" {{ route('storecategory') }} " method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmaill">
                                    Category Name
                                </label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmaill"
                                    aria-describedby="emailHelp">
                                @error('category_name')

                                    <span class="text-danger">

                                        {{ $message }}
                                    </span>


                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"> Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
