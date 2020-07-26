<div class="box-body">
    <div class="form-group">
        {{ Form::label('latitude', trans('validation.attributes.backend.zumhicachecoordinates.latitude'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('latitude', null, [
                'class' => 'form-control box-size', 
                'placeholder' => trans('validation.attributes.backend.zumhicachecoordinates.latitude'), 
                'required' => 'required'
            ]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('longitude', trans('validation.attributes.backend.zumhicachecoordinates.longitude'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('longitude', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicachecoordinates.longitude'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div><!--box-body-->

@section("after-scripts")
    {{ Html::script('js/plugin/input-mask/jquery.inputmask.js') }}
    {{ Html::script('js/plugin/input-mask/jquery.inputmask.extensions.js') }}
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            $("#latitude").inputmask({
                mask: "99.999999"
            });
            $("#longitude").inputmask({
                mask: "-99.999999"
            });
        });
    </script>
@endsection
