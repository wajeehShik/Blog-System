<x-front-layout>
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Register</h3>
<form method="post" action="{{route('register')}}" enctype="multipart/form-data" style="width:800px">
    @csrf
                        <div class="account__form">
                            <div class="input__box">
                                <label for="name">Name *</label>
                                <input type="text" name="name" value="{{old('name')}}" placeholder="Enter name">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="username">Username *</label>
                                <input type="text" name="username" value="{{old('username')}}" placeholder="Enter username">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="email">Email *</label>
                                <input type="email" name="email" value="{{old('email')}}" placeholder="Enter email">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="mobile">Mobile *</label>
                                <input type="text" name="mobile" value="{{old('mobile')}}" placeholder="Enter mobile" min="10" max="10">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="password">Password *</label>
                                <input type="password" name="password" id="password" placeholder="Enter password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="password_confirmation">Re-Password *</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter Re-Password">
                                @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="image">image *</label>
                                <input type="file" name="image" id="image">
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form__btn">
                                <button>Create account</button>
                            </div>
                            <a class="forget_pass" href="{{ route('login') }}">Login?</a>
                        </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>