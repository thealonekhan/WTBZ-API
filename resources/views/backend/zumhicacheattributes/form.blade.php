<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.zumhicacheattributes.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributes.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('isOn', trans('validation.attributes.backend.zumhicacheattributes.isOn'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('isOn', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('imageUrl', trans('validation.attributes.backend.zumhicacheattributes.imageUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('imageUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheattributes.imageUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
