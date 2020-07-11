<div class="box-body">
<div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.zumhicacheattributetypes.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributetypes.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('attribute_id', trans('validation.attributes.backend.zumhicacheattributetypes.attribute_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('attribute_id', $attributes, null, ['class' => 'form-control dd-attribute box-size', 'placeholder' => 'Select an Attribute', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('hasYesOption', trans('validation.attributes.backend.zumhicacheattributetypes.hasYesOption'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('hasYesOption', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('hasNoOption', trans('validation.attributes.backend.zumhicacheattributetypes.hasNoOption'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('hasNoOption', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('yesIconUrl', trans('validation.attributes.backend.zumhicacheattributetypes.yesIconUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('yesIconUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributetypes.yesIconUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('noIconUrl', trans('validation.attributes.backend.zumhicacheattributetypes.noIconUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('noIconUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributetypes.noIconUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('notChosenIconUrl', trans('validation.attributes.backend.zumhicacheattributetypes.notChosenIconUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('notChosenIconUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributetypes.notChosenIconUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            jQuery(".dd-attribute").select2({
                    placeholder: "Select an Attribute",
                    allowClear: true
                });
        });
    </script>
@endsection
