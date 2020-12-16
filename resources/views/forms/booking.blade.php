@include('layouts/includes/header')


    
<section class="booking ">
    <h3 class="bg-secondary">Book Your ticket</h3>
    <div class="form-booking ">
        <div class="container  ">
            <form action="{{url('/book')}}" method="post" class=" m-auto" id="form1">
                @csrf
                
            <div class="row">
                @if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
                <!-- the status of booking (done or not)-->
                @if (session('msg'))
                <div class="text-success  pb-4 text-center">
                  {{ session('msg') }}
                </div>
                @endif
               
                            <div class="col-md-6">
                                <label for="" class="mb-3">From: </label>

                                <select class="form-select mb-3  dynamic start" aria-label="Default select example" id="regionFrom" name="regionFrom" data-dependent="regionTo">
                                    <option selected value=""> From</option>
                                    @foreach($country_list as $country)
                                <option value="{{$country->regionFrom}}">{{$country->regionFrom}}</option>
                                    @endforeach
                                  
                                  </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="mb-3">To: </label>


                                <select class="form-select mb-3 dynamic end " aria-label="Default select example" id="regionTo" name="regionTo" data-number="seat_no" >

                                    <option selected value=""> To</option>

                             
                                  </select>
                            </div>
                            <div class="form-group">
                                @if($seats->count()>0)
                                <label for="" class="mb-3">Available Tickets: </label>


                                <select class="form-select mb-3  text-center end" aria-label="Default select example" name="seat_no" id="seat_no" >
                                    @foreach($seats as $seat)
                                    <option value={{$seat->seat_no}}>{{$seat->seat_no}}</option>
                                    @endforeach
                                   

                                    
                                

                                  </select>
                                  @else
                                  <p class="text-center text-danger pt-4">Complete Bus !</p>


                                  @endif
                            </div>
{{ csrf_field() }}
                 <div class="button text-center">
                     <button class="btn btn-secondary "> Confirm</button>
                 </div>
                 
            </div>
        </form>

        </div>
    </div>

</section>
<script>
    $(document).ready(function(){
        $('.dynamic').change(function(){
            if($(this).val()!=''){
                // send data of region from to determine redion to 
                var select=$(this).attr("id");//region From
                var value=$(this).val();//value of regien From
                var dependent=$(this).data('dependent'); //region To
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('RegionsController.fetch')}}",
                    method:"POST",
                    data:{select:select,value:value,_token:_token,dependent:dependent},
                    success:function(result){
                    $('#'+dependent).html(result);
                 


               
                    }
                })

            }
        })
        
        $('.end').change(function(){
            if($(this).val()!=''){
                if($(this).val()!=''){
                // send data of region from to determine redion to 
                var select=$(this).attr("id");//region From
                var value=$(this).val();//value of regien From
                var dependent=$(this).data('number'); //region To
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('TripController.fetch')}}",
                    method:"POST",
                    data:{select:select,value:value,_token:_token,number:dependent},
                    success:function(result){
                    $('#'+dependent).html(result);
                    console.log(select);
                    console.log(value);

                 


               
                    }
                })

            }
    
            } 

        })

    })
    </script>

