@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.listzumhicaches.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.listzumhicaches.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.listzumhicaches.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.listzumhicaches.partials.listzumhicaches-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="listzumhicaches-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.listzumhicaches.table.id') }}</th>
                            <th>{{ trans('labels.backend.listzumhicaches.table.listItemName') }}</th>
                            <th>{{ trans('labels.backend.listzumhicaches.table.zumhiCode') }}</th>
                            <th>{{ trans('labels.backend.listzumhicaches.table.listCode') }}</th>
                            <th>{{ trans('labels.backend.listzumhicaches.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th>
                            {!! Form::text('listItemName', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.listzumhicaches.table.listItemName')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('zumhiCode', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => trans('labels.backend.listzumhicaches.table.zumhiCode')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('listCode', null, ["class" => "search-input-text form-control", "data-column" => 3, "placeholder" => trans('labels.backend.listzumhicaches.table.listCode')]) !!}
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
            
            var dataTable = $('#listzumhicaches-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.listzumhicaches.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.listzumhicaches.table')}}.id'},
                    {data: 'listItemName', name: '{{config('module.listzumhicaches.table')}}.listItemName'},
                    {data: 'zumhiCode', name: '{{config('module.listzumhicaches.table')}}.zumhiCode'},
                    {data: 'listCode', name: '{{config('module.listzumhicaches.table')}}.listCode'},
                    {data: 'created_at', name: '{{config('module.listzumhicaches.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
