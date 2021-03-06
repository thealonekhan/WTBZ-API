@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.zumhicachelogs.management') . ' | ' . trans('labels.backend.zumhicachelogs.show'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.zumhicachelogs.management') }}
        <small>{{ trans('labels.backend.zumhicachelogs.show') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.zumhicachelogs.show') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.zumhicachelogs.partials.zumhicachelogs-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{ trans('labels.backend.zumhicachelogs.tabs.titles.overview') }}</a>
                    </li>

                    <li role="presentation">
                        <a href="#history" aria-controls="history" role="tab" data-toggle="tab">{{ trans('labels.backend.zumhicachelogs.tabs.titles.history') }}</a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane mt-30 active" id="overview">
                        @include('backend.zumhicachelogs.show.tabs.overview')
                    </div><!--tab overview profile-->

                    <div role="tabpanel" class="tab-pane mt-30" id="history">
                        @include('backend.zumhicachelogs.show.tabs.history')
                    </div><!--tab panel history-->

                </div><!--tab content-->

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection