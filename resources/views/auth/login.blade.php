<x-front-layout>
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Login</h3>
            <form action="{{route('login')}}" method="post" style="width:640px;">
                @csrf
                        <div class="account__form">
                            <div class="input__box">
                                <label for="email">email *</label>
     <input type="text" name="email" value="{{old('email')}}" placeholder="Enter User Name" required/>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input__box">
                                <label for="password">password *</label>
                                <input type="password" name="password" placeholder="Enter the password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form__btn">
                                <button>Login</button>
                                <label class="label-for-checkbox">
                                    <input class="input-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span>Remember me</span>
                                </label>
                            </div>
                            <a class="forget_pass" href="{{ route('password.request') }}">Lost your password?</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>