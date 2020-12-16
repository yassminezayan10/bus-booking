@extends('layouts/layout')


   @section('content')
       
<section class="booking ">
    <h3 class="bg-secondary">Login</h3>
    <div class="form-booking ">
        <div class="container  ">
            <form action="{{url('/login')}}" method="post" class=" m-auto" id="form1" >
                @csrf

            <div class="row">
                @if (session('auth'))
                <div class="text-danger  pb-4 text-center">
                  {{ session('auth') }}
                </div>
                @endif
                @if($errors->has('notLog'))

                <div class="text-danger  p-3 text-center">{{ $errors->first('notLog') }}</div>
               
              @endif

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                                @if($errors->has('email'))

                                <div class="text-danger ">{{ $errors->first('email') }}</div>
                               
                            @endif
                              </div>
                            
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" name="password" id="" class="form-control mb-3" placeholder="Password" aria-describedby="helpId">
                                @if($errors->has('password'))

                                <div class="text-danger ">{{ $errors->first('password') }}</div>
                               
                            @endif
                              </div>
                           
<div class="register2">
<p>You Don't have an  account <a href="{{url('/register')}}" class="text-secondary px-3">Register now !</a></p>
</div>
                 <div class="button text-center">
                     <button class="btn btn-secondary "> Login</button>
                 </div>
            </div>
        </form>

        </div>
    </div>

</section>
@endsection 