@extends('layouts/layout')


   @section('content')
       
<section class="register ">
    <h3 class="bg-secondary">Register</h3>
    <div class="form-booking ">
        <div class="container  ">
            <form action="{{url('/register')}}" method="post" class=" m-auto" id="form1" >
                @csrf

            <div class="row">
              
                            <div class="col-md-6">
                                <label for="" class="mb-3">First Name: </label>

                                <input type="text" name="firstName" id="" class="form-control mb-3" placeholder="First Name" aria-describedby="helpId">
                                @if($errors->has('firstName'))

                                <div class="text-danger ">{{ $errors->first('firstName') }}</div>
                               
                            @endif
             

                            </div>
                            <div class="col-md-6">
                                <label for="" class="mb-3">Last Name: </label>

                                <input type="text" name="lastName" id="" class="form-control mb-3" placeholder="Last Name" aria-describedby="helpId">
                                @if($errors->has('lastName'))

                                <div class="text-danger ">{{ $errors->first('lastName') }}</div>
                               
                            @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                                @if($errors->has('email'))

                                <div class="text-danger ">{{ $errors->first('email') }}</div>
                               
                            @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                <input type="text" name="phone" id="" class="form-control mb-3" placeholder="Phone" aria-describedby="helpId">
                                @if($errors->has('phone'))

                                <div class="text-danger" >{{ $errors->first('phone') }}</div>
                               
                            @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" name="password" id="" class="form-control mb-3" placeholder="Password" aria-describedby="helpId">
                                @if($errors->has('password'))

                                <div class="text-danger ">{{ $errors->first('password') }}</div>
                               
                            @endif
                              </div>
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password Confirmation</label>
                                <input type="password" name="confirm_password" id="" class="form-control mb-3" placeholder="Password Confirmation" aria-describedby="helpId">
                                @if($errors->has('confirm_password'))
                                <div class="text-danger ">{{ $errors->first('confirm_password') }}</div>
                            @endif
                              </div>


                 <div class="button text-center">
                     <button class="btn btn-secondary "> Register</button>
                 </div>
            </div>
        </form>

        </div>
    </div>

</section>
@endsection 
