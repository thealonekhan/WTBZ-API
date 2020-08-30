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
        {{ Form::label('name', trans('validation.attributes.backend.sponsors.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.sponsors.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('relatedWebPage', trans('validation.attributes.backend.sponsors.relatedWebPage'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('relatedWebPage', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.sponsors.relatedWebPage')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('relatedWebPageText', trans('validation.attributes.backend.sponsors.relatedWebPageText'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('relatedWebPageText', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.sponsors.relatedWebPageText')]) }}
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
        Backend.Trackable.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
    </script>
@endsection
