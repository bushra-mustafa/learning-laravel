<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

      <b style="float: left"> All Brands </b>
      <b style="float: right"> Total Brands
        <span class="badge badge-danger">
          {{ count($images) }}
        </span></b>
    </h2><br>
  </x-slot>
  <div class="py-12">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">


          </div>
        </div>
        <div class="col-md-4 ">
          <div class="card ">
            <div class="card-header"> Muti Image </div>
            <div class="card-body ">
              <form action=" {{ route('StorMulti') }} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">
                    Multi Image
                  </label>
                  <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" multiple=>
                  @error('image')
                    <span class="text-danger">
                      {{ $message }}
                    </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary"> Add
                  Image
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
