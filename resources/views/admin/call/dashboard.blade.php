@extends('admin.layouts.app')

@section('title','Админстрация')

@section('content')
@include('admin.components.message')
<div class="container-fluid">
<br>
        <h2>Заявки</h2>
        <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="call-tab" data-toggle="tab" href="#call" role="tab" aria-controls="call" aria-selected="true"><i class="fas fa-copyright"></i>Заявки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false"><i class="fas fa-flag"></i> Заявки с Ссылкой</a>
                        </li>
                    </ul>
                </div>
                 <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="call" role="tabpanel" aria-labelledby="call-tab">
                        @include('admin.call.index')
                    </div>

                    <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                        @include('admin.call.callUrl.index')
                    </div>
                 </div>
                </div>
        </div>
    </div>
</div>

@endsection
