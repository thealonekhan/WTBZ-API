@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.zumhicacheattributes.management') . ' | ' . trans('labels.backend.zumhicacheattributes.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.zumhicacheattributes.management') }}
        <small>{{ trans('labels.backend.zumhicacheattributes.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($zumhicacheattributes, ['route' => ['admin.zumhicacheattributes.update', $zumhicacheattribute], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-zumhicacheattribute']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.zumhicacheattributes.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.zumhicacheattributes.partials.zumhicacheattributes-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.zumhicacheattributes.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.zumhicacheattributes.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
