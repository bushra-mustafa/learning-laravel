<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

      <b style="float: left"> All Brands </b>
      <b style="float: right"> Total Brands
        <span class="badge badge-danger">
          {{-- {{ count($categories) }} --}}
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

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card-header"> All brand </div>
            <table class="table ">
              <thead>
                <tr>
                  <th scope="col">Sl number</th>
                  <th scope="col">Brand Name</th>
                  <th scope="col">Brand Imge</th>
                  <th scope="col">Created at </th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($brands as $brand)

                  <tr>

                    <th scope="row">
                      {{ $brands->firstItem() + $loop->index }}
                    </th>
                    <td>{{ $brand->brand_name }}
                    </td>
                    <td><img src="" alt=""></td>
                    <td>
                      @if ($brand->created_at == null)
                        <span class="text-danger">
                          NOT DATA SET
                        </span>
                      @else
                        {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                      @endif
                    </td>
                    <td>
                      {{-- <a href=" {{ url('brand/edit/' . $brand->id) }}
                     " class="btn btn-info">Edit</a>
                      <a href="{{ url('softdelete/brand/' . $brand->id) }}" class="btn btn-danger">delete</a> --}}
                    </td>

                  </tr>
                @endforeach

              </tbody>
            </table>
            {{ $brands->Links() }}
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="cards">
            <div class="card-header"> Add brand </div>
            <form action=" {{ route('storecategory') }} " method="POST">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">
                  Brand Name
                </label>
                <input type="text" name="Brand_name" class="form-control" id="exampleInputEmail1"
                  aria-describedby="emailHelp">
                @error('brand_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">
                  Brand Image
                </label>
                <input type="file" name="brand_imge" class="form-control" id="exampleInputEmail1"
                  aria-describedby="emailHelp">
                @error('brand_imge')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary"> Add
                brand</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
