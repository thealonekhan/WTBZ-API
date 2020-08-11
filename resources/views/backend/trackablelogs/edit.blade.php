@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.trackablelogs.management') . ' | ' . trans('labels.backend.trackablelogs.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.trackablelogs.management') }}
        <small>{{ trans('labels.backend.trackablelogs.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($trackablelogs, ['route' => ['admin.trackablelogs.update', $trackablelog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-trackablelog']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.trackablelogs.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.trackablelogs.partials.trackablelogs-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.trackablelogs.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.trackablelogs.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
