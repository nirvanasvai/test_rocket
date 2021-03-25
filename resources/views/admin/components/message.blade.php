@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if ($errors->any())
    <div class="form-authorization__error error-authorization">
        <div class="error-authorization__row">
            <div class="error-authorization__col">
                <div class="error-authorization__alert">
                    <img src="/public/img/authorization/report.svg" alt="" />
                </div>
            </div>
            <div class="error-authorization__col">
                <div class="error-authorization__text" id="dump">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="" class="error-authorization__close"></a>
    </div>
@endif
