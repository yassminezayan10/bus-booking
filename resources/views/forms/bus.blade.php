@include('layouts/includes/header')


    
<section class="booking ">
    <h3 class="bg-secondary">Create Bus</h3>
    <div class="form-booking ">
        <div class="container  ">
            <form action="{{url('/bus')}}" method="post" class=" m-auto" id="form1">
                @csrf
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" placeholder="Driver Name" aria-label="default input example" name="driver_name">

                                
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Last Station" aria-label="default input example" name="last_city">

                    
                            </div>
{{ csrf_field() }}
                 <div class="button text-center">
                     <button class="btn btn-secondary " type="submit"> Create</button>
                 </div>
            </div>
        </form>

        </div>
    </div>

</section>