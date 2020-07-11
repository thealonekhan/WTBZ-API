@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.zumhicacheattributetypes.management') . ' | ' . trans('labels.backend.zumhicacheattributetypes.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.zumhicacheattributetypes.management') }}
        <small>{{ trans('labels.backend.zumhicacheattributetypes.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($zumhicacheattributetype, ['route' => ['admin.zumhicacheattributetypes.update', $zumhicacheattributetype], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-zumhicacheattributetype']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.zumhicacheattributetypes.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.zumhicacheattributetypes.partials.zumhicacheattributetypes-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.zumhicacheattributetypes.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.zumhicacheattributetypes.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!--form-group-->
            </div><!--box-body-->
        </div><!--box box-success -->
    {{ Form::close() }}
@endsection
