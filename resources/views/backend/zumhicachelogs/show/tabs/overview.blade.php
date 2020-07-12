<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.referenceCode') }}</th>
        <td>{{ $zumhicachelog->referenceCode }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.zumhicacheCode') }}</th>
        <td>{{ $zumhicacheCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.zumhicacheName') }}</th>
        <td>{{ $zumhicacheName }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.ownerCode') }}</th>
        <td>{{ $ownerCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.logType') }}</th>
        <td>{{ $logType }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.coordinates') }}</th>
        <td>{{ $coordinates }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.loggedDate') }}</th>
        <td>{!! $zumhicachelog->loggedDate !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.text') }}</th>
        <td>{!! $zumhicachelog->text !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.usedFavoritePoint') }}</th>
        <td>{!! $zumhicachelog->usedFavoritePoint ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.isEncoded') }}</th>
        <td>{!! $zumhicachelog->isEncoded ? 'YES' : 'NO' !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.isArchived') }}</th>
        <td>{!! $zumhicachelog->isArchived ? 'YES' : 'NO' !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.url') }}</th>
        <td>{!! $zumhicachelog->url !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicachelog->created_at }} ({{ $zumhicachelog->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicachelog->updated_at }} ({{ $zumhicachelog->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicachelog->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicachelogs.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicachelog->deleted_at }} ({{ $zumhicachelog->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>