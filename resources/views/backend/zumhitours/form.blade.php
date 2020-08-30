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
        {{ Form::label('referenceCode', trans('validation.attributes.backend.zumhitours.referenceCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('referenceCode', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhitours.referenceCode'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.zumhitours.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhitours.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('coordinates_id', trans('validation.attributes.backend.zumhitours.coordinates_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('coordinates_id', $coordinates, null, ['class' => 'form-control dd-coordinates box-size', 'placeholder' => 'Select Coordinates', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('sponsor_id', trans('validation.attributes.backend.zumhitours.sponsor_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('sponsor_id', $sponsors, null, ['class' => 'form-control dd-sponsor box-size', 'placeholder' => 'Select Sponsor', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('zumhicaches', trans('validation.attributes.backend.zumhitours.zumhicaches'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
        @if(!empty($selectedZumhicaches))
            {{ Form::select('zumhicaches[]', $zumhicaches, $selectedZumhicaches, ['class' => 'form-control zumhicaches-tags box-size', 'multiple' => 'multiple']) }}
        @else
            {{ Form::select('zumhicaches[]', $zumhicaches, null, ['class' => 'form-control zumhicaches-tags box-size', 'multiple' => 'multiple']) }}
        @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('description', trans('validation.attributes.backend.zumhitours.description'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.zumhitours.description')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('url', trans('validation.attributes.backend.zumhitours.url'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhitours.url')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('coverImageUrl', trans('validation.attributes.backend.zumhitours.coverImageUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('coverImageUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhitours.coverImageUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('logoImageUrl', trans('validation.attributes.backend.zumhitours.logoImageUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('logoImageUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhitours.logoImageUrl')]) }}
        </div><!--col-lg-10-->
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

        //Backend.Blog.selectors.SlugUrl = "{{url('/')}}";
        Backend.Trackable.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
        //$('.datetimepicker1').datetimepicker();
        $( document ).ready( function() {
            jQuery(".zumhicaches-tags").select2({
                placeholder: "Select ZumhiCaches",
                allowClear: true,
                tags: true,
            });
            jQuery(".dd-sponsor").select2({
                placeholder: "Select Sponsor",
                allowClear: true,
            });
            jQuery(".dd-coordinates").select2({
                placeholder: "Select Coordinates",
                allowClear: true,
            });
        });
        
    </script>
@endsection
