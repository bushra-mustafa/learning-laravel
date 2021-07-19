<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b style="float: left"> All Category
            </b>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> All Category </div>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Sl number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Category </div>
                        <form action=" {{ route('store.category') }} " method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmaill">
                                    Category Name
                                </label>
                                <input type="text" class="form-control" id="exampleInputEmaill"
                                    aria-describedby="emailHelp">

                            </div>
                            <button type="submit" class="btn btn-primary"> Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
