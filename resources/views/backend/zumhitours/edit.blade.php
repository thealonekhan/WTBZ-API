@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.zumhitours.management') . ' | ' . trans('labels.backend.zumhitours.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.zumhitours.management') }}
        <small>{{ trans('labels.backend.zumhitours.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($zumhitour, ['route' => ['admin.zumhitours.update', $zumhitour], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-zumhitour']) }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.zumhitours.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.zumhitours.partials.zumhitours-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.zumhitours.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.zumhitours.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
