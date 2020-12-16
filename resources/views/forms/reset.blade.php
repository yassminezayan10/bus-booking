@include('layouts/includes/header')


    
<section class="booking ">
    <h3 class="bg-secondary">Book Your ticket</h3>
    <div class="form-booking ">
        <div class="container  ">
            <form action="{{url('/reset')}}" method="post" class=" m-auto" id="form1">
                @csrf
                <div class="form-group">

@foreach($bus as $driver)
                    <select class="form-select mb-3 dynamic end " aria-label="Default select example" name="driver_name"  >

<option value="{{$driver->driver}}"> {{$driver->driver}}</option>
                 
                      </select>
                      @endforeach
                </div>
                          
{{ csrf_field() }}
                 <div class="button text-center">
                     <button class="btn btn-secondary " type="submit"> Reset</button>
                 </div>
            </div>
        </form>

        </div>
    </div>

</section>