@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.trackablelogs.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.trackablelogs.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.trackablelogs.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.trackablelogs.partials.trackablelogs-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="trackablelogs-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.trackablelogs.table.id') }}</th>
                            <th>{{ trans('labels.backend.trackablelogs.table.referenceCode') }}</th>
                            <th>{{ trans('labels.backend.trackablelogs.table.ownerCode') }}</th>
                            <th>{{ trans('labels.backend.trackablelogs.table.trackableCode') }}</th>
                            <th>{{ trans('labels.backend.trackablelogs.table.zumhiCode') }}</th>
                            <th>{{ trans('labels.backend.trackablelogs.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th>
                            {!! Form::text('referenceCode', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.trackablelogs.table.referenceCode')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('trackableCode', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.trackablelogs.table.trackableCode')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('ownerCode', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.trackablelogs.table.ownerCode')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('zumhiCode', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.trackablelogs.table.zumhiCode')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script('js/dataTable.js') }}

    <script>
        //Below written line is short form of writing $(document).ready(function() { })
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var dataTable = $('#trackablelogs-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.trackablelogs.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.trackablelogs.table')}}.id'},
                    {data: 'referenceCode', name: '{{config('module.trackablelogs.table')}}.referenceCode'},
                    {data: 'trackableCode', name: '{{config('module.trackablelogs.table')}}.trackableCode'},
                    {data: 'ownerCode', name: '{{config('module.trackablelogs.table')}}.ownerCode'},
                    {data: 'zumhiCode', name: '{{config('module.trackablelogs.table')}}.zumhiCode'},
                    {data: 'created_at', name: '{{config('module.trackablelogs.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
