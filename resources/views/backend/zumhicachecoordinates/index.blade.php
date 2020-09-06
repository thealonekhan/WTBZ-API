@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.zumhicachecoordinates.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.zumhicachecoordinates.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.zumhicachecoordinates.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.zumhicachecoordinates.partials.zumhicachecoordinates-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="zumhicachecoordinates-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.zumhicachecoordinates.table.id') }}</th>
                            <th>{{ trans('labels.backend.zumhicachecoordinates.table.latitude') }}</th>
                            <th>{{ trans('labels.backend.zumhicachecoordinates.table.longitude') }}</th>
                            <th>{{ trans('labels.backend.zumhicachecoordinates.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th>
                            {!! Form::text('latitude', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.zumhicachecoordinates.table.latitude')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                            {!! Form::text('longitude', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => trans('labels.backend.zumhicachecoordinates.table.longitude')]) !!}
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
            
            var dataTable = $('#zumhicachecoordinates-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.zumhicachecoordinates.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.zumhicachecoordinates.table')}}.id'},
                    {data: 'latitude', name: '{{config('module.zumhicachecoordinates.table')}}.latitude'},
                    {data: 'longitude', name: '{{config('module.zumhicachecoordinates.table')}}.longitude'},
                    {data: 'created_at', name: '{{config('module.zumhicachecoordinates.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
