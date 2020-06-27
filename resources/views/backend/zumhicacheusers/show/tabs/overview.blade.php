<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.referenceCode') }}</th>
        <td>{{ $zumhicacheuser->referenceCode }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.user_id') }}</th>
        <td>{{ $user }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.membership_id') }}</th>
        <td>{{ $membership }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.joinedDateUtc') }}</th>
        <td>{!! $zumhicacheuser->joinedDateUtc !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.avatarUrl') }}</th>
        <td>{!! $zumhicacheuser->avatarUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.bannerUrl') }}</th>
        <td>{!! $zumhicacheuser->bannerUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.url') }}</th>
        <td>{!! $zumhicacheuser->url !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.profileText') }}</th>
        <td>{!! $zumhicacheuser->profileText !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.coordinates_id') }}</th>
        <td>{!! $coordinates !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.isFriend') }}</th>
        <td>{!! $zumhicacheuser->isFriend ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.optedInFriendSharing') }}</th>
        <td>{!! $zumhicacheuser->optedInFriendSharing ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicacheuser->created_at }} ({{ $zumhicacheuser->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicacheuser->updated_at }} ({{ $zumhicacheuser->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicacheuser->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicacheusers.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicacheuser->deleted_at }} ({{ $zumhicacheuser->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>