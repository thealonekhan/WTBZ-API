<div class="box-body">
    <div class="form-group">
        {{ Form::label('referenceCode', trans('validation.attributes.backend.zumhicache.referenceCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('referenceCode', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.referenceCode'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.zumhicache.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('difficulty', trans('validation.attributes.backend.zumhicache.difficulty'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::number('difficulty', null, ['class' => 'form-control box-size', 'min'=> '1.0', 'max' => '5.0', 'step' => '0.1', 'placeholder' => trans('validation.attributes.backend.zumhicache.difficulty'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('terrain', trans('validation.attributes.backend.zumhicache.terrain'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::number('terrain', null, ['class' => 'form-control box-size', 'min'=> '1.0', 'max' => '5.0', 'step' => '0.1', 'placeholder' => trans('validation.attributes.backend.zumhicache.terrain'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('placedDate', trans('validation.attributes.backend.zumhicache.placedDate'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(!empty($zumhicache->placedDate))
                {{ Form::text('placedDate', \Carbon\Carbon::parse($zumhicache->placedDate)->format('m/d/Y h:i a'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.placedDate')]) }}
            @else
                {{ Form::text('placedDate', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.placedDate')]) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('publishedDate', trans('validation.attributes.backend.zumhicache.publishedDate'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(!empty($zumhicache->publishedDate))
                {{ Form::text('publishedDate', \Carbon\Carbon::parse($zumhicache->publishedDate)->format('m/d/Y h:i a'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.publishedDate')]) }}
            @else
                {{ Form::text('publishedDate', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.publishedDate')]) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('eventEndDate', trans('validation.attributes.backend.zumhicache.eventEndDate'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(!empty($zumhicache->eventEndDate))
                {{ Form::text('eventEndDate', \Carbon\Carbon::parse($zumhicache->eventEndDate)->format('m/d/Y h:i a'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.eventEndDate')]) }}
            @else
                {{ Form::text('eventEndDate', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.eventEndDate')]) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('user_id', trans('validation.attributes.backend.zumhicache.user_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('user_id', $users, null, ['class' => 'form-control dd-user box-size', 'placeholder' => 'Select a User', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('type_id', trans('validation.attributes.backend.zumhicache.type_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('type_id', $types, null, ['class' => 'form-control dd-type box-size', 'placeholder' => 'Select a Type', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('size_id', trans('validation.attributes.backend.zumhicache.size_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('size_id', $sizes, null, ['class' => 'form-control dd-size box-size', 'placeholder' => 'Select a Size', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('country_id', trans('validation.attributes.backend.zumhicache.country_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('country_id', $countries, null, ['class' => 'form-control dd-country box-size', 'placeholder' => 'Select a Country', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('state_id', trans('validation.attributes.backend.zumhicache.state_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10" id="state-dd-area">
        @if(!empty($selectedStates))
            {{ Form::select('state_id', $selectedStates, null, ['class' => 'form-control dd-state box-size', 'required' => 'required']) }}
        @else
            {{ Form::select('state_id', [], null, ['class' => 'form-control dd-state box-size', 'required' => 'required']) }}
        @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('ianaTimezoneId', trans('validation.attributes.backend.zumhicache.ianaTimezoneId'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('ianaTimezoneId', $timezoneids, null, ['class' => 'form-control dd-timezone box-size', 'placeholder' => 'Select a Timezone', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('coordinates_id', trans('validation.attributes.backend.zumhicache.coordinates_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('coordinates_id', $coordinates, null, ['class' => 'form-control dd-coordinates box-size', 'placeholder' => 'Select Coordinates', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('shortDescription', trans('validation.attributes.backend.zumhicache.shortDescription'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('shortDescription', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.zumhicache.shortDescription')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('longDescription', trans('validation.attributes.backend.zumhicache.longDescription'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('longDescription', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.zumhicache.longDescription')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('hints', trans('validation.attributes.backend.zumhicache.hints'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('hints', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.hints')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('relatedWebPage', trans('validation.attributes.backend.zumhicache.relatedWebPage'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('relatedWebPage', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.relatedWebPage')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('url', trans('validation.attributes.backend.zumhicache.url'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicache.url')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('containsHtml', trans('validation.attributes.backend.zumhicache.containsHtml'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('containsHtml', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('hasSolutionChecker', trans('validation.attributes.backend.zumhicache.hasSolutionChecker'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('hasSolutionChecker', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('status_id', trans('validation.attributes.backend.zumhicache.status_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('status_id', $statuses, null, ['class' => 'form-control dd-status box-size', 'placeholder' => 'Select a Status', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
</div>

@section("after-scripts")
    <script type="text/javascript">

        //Backend.Blog.selectors.SlugUrl = "{{url('/')}}";
        Backend.ZumhiCache.selectors.StateAjaxUrl = "{{url('/admin/zumhicaches/getstate')}}";
        Backend.ZumhiCache.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
        //$('.datetimepicker1').datetimepicker();
        
    </script>
@endsection