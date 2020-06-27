@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.statuses.management') . ' | ' . trans('labels.backend.statuses.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.statuses.management') }}
        <small>{{ trans('labels.backend.statuses.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($statuses, ['route' => ['admin.statuses.update', $status], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-status']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.statuses.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.statuses.partials.statuses-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.statuses.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.statuses.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
