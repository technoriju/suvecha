@include('layouts.head')
    <section class="loginWrap">
        <article>
            <h1>edmars pharma</h1>
            <p>fill the below information to login</p>
        </article>
        <div class="mainLoginBox">
            <h4>login account</h4>

            @if(isset($errors) && count($errors)>0)
            <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
            @endif
            @if(session('error')!==null)
                <div class="alert alert-danger" role="alert">{{session('error')}}</div>
            @endif

            <form action="{{url('/')}}" method="post">
                @csrf
                <input type="text" name="username" placeholder="Phone No" class="usrInput" />
                <input type="password" name="password" placeholder="Password" class="usrInput" />
                <a href="#" class="fppw">forgot password?</a>
                <input type="submit" value="submit" class="subbtn">
            </form>
        </div>
    </section>
</body>
</html>
