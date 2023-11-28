@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Trabajadora
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Trabajadora</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trabajadoras.update', $trabajadora->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('trabajadora.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
