@extends('adminlte::page')

@section('template_title')
    Trabajadora
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Trabajadora') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('trabajadoras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                       
                                        <th>id</th>
										<th>Ci</th>
										<th>Especialidad</th>
										<th>Horario</th>
										<th>Nombre</th>
										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trabajadoras as $trabajadora)
                                        <tr>
                                           
                                            <td>{{ $trabajadora->id }}</td>
											<td>{{ $trabajadora->Ci }}</td>
											<td>{{ $trabajadora->Especialidad }}</td>
											<td>{{ $trabajadora->Horario }}</td>
											<td>{{ $trabajadora->Nombre }}</td>
											

                                            <td>
                                                <form action="{{ route('trabajadoras.destroy',$trabajadora->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('trabajadoras.show',$trabajadora->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('trabajadoras.edit',$trabajadora->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $trabajadoras->links() !!}
            </div>
        </div>
    </div>
@endsection
