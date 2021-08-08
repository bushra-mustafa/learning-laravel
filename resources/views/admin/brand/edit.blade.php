<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <b style="float: left"> Edit Brand </b>
      <b style="float: right"> Total Brand
        <span class="badge badge-danger">
        </span></b>
    </h2><br>
  </x-slot>
  <div class="py-12">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header"> Edit brand </div>
            <div class="card-body">

              <form action="{{ url('brand/update/' . $brands->id) }} " method="POST" enctype="multipart/form-data">
                <input name="old_image" type="hidden" value="{{ $brands->brand_image }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">
                    Update Brand name
                  </label>
                  <input type="text" name="brand_name" class="form-control" id="exampleInputEmaill"
                    aria-describedby="emailHelp" value="{{ $brands->brand_name }}">
                  @error('brand_name')
                    <span class="text-danger">

                      {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">
                    Update Brand Image
                  </label>
                  <input type="file" name="brand_image" class="form-control" id="exampleInputEmaill"
                    aria-describedby="emailHelp" value="{{ $brands->brand_image }}">



                  @error('brand_image')
                    <span class="text-danger">

                      {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group items-center">

                  <img src="{{ asset($brands->brand_image) }}" alt="{{ $brands->brad_name }}"
                    style="height: 200px; width:400px;">
                </div>

                <button type="submit" class="btn btn-primary"> Update
                  Brand</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
