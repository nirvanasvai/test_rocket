@extends('admin.layouts.app')

@section('title','Фильтры')

@section('content')
    @include('admin.components.message')

<div class="container-fluid">
    <br>
    <h2>Основные фильтры</h2>
    <br>
    <div class="row">
        <div class="col-12">
        <div class="card mt-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="brand-tab" data-toggle="tab" href="#brand" role="tab" aria-controls="brand" aria-selected="true"><i class="fas fa-copyright"></i> Бренды</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="country-tab" data-toggle="tab" href="#country" role="tab" aria-controls="country" aria-selected="false"><i class="fas fa-flag"></i> Страны</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="color-tab" data-toggle="tab" href="#color" role="tab" aria-controls="color" aria-selected="false"><i class="fas fa-tint"></i> Цвета</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="brand" role="tabpanel" aria-labelledby="brand-tab">
            @include('admin.criterion.brand.index')
        </div>
        <div class="tab-pane fade" id="country" role="tabpanel" aria-labelledby="country-tab">
            @include('admin.criterion.country.index')
        </div>
        <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
            @include('admin.criterion.color.index')
        </div>

    </div>
    </div>
    </div>

    </div>
</div>

@endsection
