<div class="box-body">
    <div class="form-group">
        {{ Form::label('referenceCode', trans('validation.attributes.backend.zumhicacheuser.referenceCode'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('referenceCode', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.referenceCode'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('user_id', trans('validation.attributes.backend.zumhicacheuser.user_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('user_id', $users, null, ['class' => 'form-control dd-user box-size', 'placeholder' => 'Select a User', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('membership_id', trans('validation.attributes.backend.zumhicacheuser.membership_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('membership_id', $memberships, null, ['class' => 'form-control dd-membership box-size', 'placeholder' => 'Select Memebership', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->


    <div class="form-group">
        {{ Form::label('joinedDateUtc', trans('validation.attributes.backend.zumhicacheuser.joinedDateUtc'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            @if(!empty($zumhicacheuser->joinedDateUtc))
                {{ Form::text('joinedDateUtc', \Carbon\Carbon::parse($zumhicacheuser->joinedDateUtc)->format('m/d/Y h:i a'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.joinedDateUtc')]) }}
            @else
                {{ Form::text('joinedDateUtc', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.joinedDateUtc')]) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('avatarUrl', trans('validation.attributes.backend.zumhicacheuser.avatarUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('avatarUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.avatarUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('bannerUrl', trans('validation.attributes.backend.zumhicacheuser.bannerUrl'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('bannerUrl', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.bannerUrl')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('url', trans('validation.attributes.backend.zumhicacheuser.url'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.url')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('profileText', trans('validation.attributes.backend.zumhicacheuser.profileText'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('profileText', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.zumhicacheuser.profileText')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('coordinates_id', trans('validation.attributes.backend.zumhicacheuser.coordinates_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::select('coordinates_id', $coordinates, null, ['class' => 'form-control dd-coordinates box-size', 'placeholder' => 'Select Coordinates', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('isFriend', trans('validation.attributes.backend.zumhicacheuser.isFriend'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('isFriend', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('optedInFriendSharing', trans('validation.attributes.backend.zumhicacheuser.optedInFriendSharing'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-1">
                <div class="control-group">
                <label class="control control--checkbox">
                    {{ Form::checkbox('optedInFriendSharing', '1', true) }}
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div><!--col-lg-1-->
    </div><!--form control-->
    
</div>

@section("after-scripts")
    <script type="text/javascript">
        Backend.ZumhiCacheUser.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');
    </script>
@endsection