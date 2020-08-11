@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box-body">
    
    <div class="form-group">
        {{ Form::label('referenceCode', trans('validation.attributes.backend.trackable.referenceCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('referenceCode', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.referenceCode'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.trackable.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('ownerCode', trans('validation.attributes.backend.trackable.ownerCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('ownerCode', $ownerCodes, null, ['class' => 'form-control dd-owner box-size', 'placeholder' => 'Select an ownerCode', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('holderCode', trans('validation.attributes.backend.trackable.holderCode'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
        {{ Form::select('holderCode', $ownerCodes, null, ['class' => 'form-control dd-holder box-size', 'placeholder' => 'Select a holderCode']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('zumhiCode', trans('validation.attributes.backend.trackable.zumhiCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('zumhiCode', $zumhiCodes, null, ['class' => 'form-control dd-zumhi box-size', 'placeholder' => 'Select a ZumhiCode', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('country_id', trans('validation.attributes.backend.trackable.country_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('country_id', $countries, null, ['class' => 'form-control dd-country box-size', 'placeholder' => 'Select a Country', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('type_id', trans('validation.attributes.backend.trackable.type_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('type_id', $types, null, ['class' => 'form-control dd-type box-size', 'placeholder' => 'Select a Type', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('goal', trans('validation.attributes.backend.trackable.goal'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('goal', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.goal')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('trackingNumber', trans('validation.attributes.backend.trackable.trackingNumber'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('trackingNumber', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.trackingNumber')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('releasedDate', trans('validation.attributes.backend.trackable.releasedDate'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(!empty($trackable->releasedDate))
                {{ Form::text('releasedDate', \Carbon\Carbon::parse($trackable->releasedDate)->format('m/d/Y'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.trackable.releasedDate')]) }}
            @else
                {{ Form::text('releasedDate', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.trackable.releasedDate')]) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('description', trans('validation.attributes.backend.trackable.description'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.trackable.description')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('kilometersTraveled', trans('validation.attributes.backend.trackable.kilometersTraveled'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::number('kilometersTraveled', null, ['class' => 'form-control box-size', 'min'=> '1.0', 'max' => '99999.0', 'step' => '0.1', 'placeholder' => trans('validation.attributes.backend.trackable.kilometersTraveled')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('milesTraveled', trans('validation.attributes.backend.trackable.milesTraveled'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::number('milesTraveled', null, ['class' => 'form-control box-size', 'min'=> '1.0', 'max' => '99999.0', 'step' => '0.1', 'placeholder' => trans('validation.attributes.backend.trackable.milesTraveled')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('iconUrl', trans('validation.attributes.backend.trackable.iconUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('iconUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.iconUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('url', trans('validation.attributes.backend.trackable.url'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.trackable.url')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('inHolderCollection', trans('validation.attributes.backend.trackable.inHolderCollection'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('inHolderCollection', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('isMissing', trans('validation.attributes.backend.trackable.isMissing'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('isMissing', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->


</div><!--box-body-->

@section("after-scripts")
    <style>
        .alert{
            width: 98%;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript">
        Backend.Trackable.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
    </script>
@endsection
