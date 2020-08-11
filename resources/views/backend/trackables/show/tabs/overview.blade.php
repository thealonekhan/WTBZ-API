<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.referenceCode') }}</th>
        <td>{{ $trackable->referenceCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.goal') }}</th>
        <td>{{ $trackable->goal }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.releasedDate') }}</th>
        <td>{{ $trackable->releasedDate }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.country_id') }}</th>
        <td>{{ $originCountry }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.ownerCode') }}</th>
        <td>{{ $trackable->ownerCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.holderCode') }}</th>
        <td>{{ $trackable->holderCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.zumhiCode') }}</th>
        <td>{{ $trackable->zumhiCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.currentZumhicacheName') }}</th>
        <td>{{ $currentZumhicacheName }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.type_id') }}</th>
        <td>{{ $trackableType }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.description') }}</th>
        <td>{!! $trackable->description !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.iconUrl') }}</th>
        <td>{!! $trackable->iconUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.url') }}</th>
        <td>{!! $trackable->url !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.trackingNumber') }}</th>
        <td>{!! $trackable->trackingNumber !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.kilometersTraveled') }}</th>
        <td>{!! $trackable->kilometersTraveled !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.milesTraveled') }}</th>
        <td>{!! $trackable->milesTraveled !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.inHolderCollection') }}</th>
        <td>{!! $trackable->inHolderCollection ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.isMissing') }}</th>
        <td>{!! $trackable->isMissing ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.created_at') }}</th>
        <td>{{ $trackable->created_at }} ({{ $trackable->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackables.tabs.content.overview.last_updated') }}</th>
        <td>{{ $trackable->updated_at }} ({{ $trackable->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($trackable->trashed())
        <tr>
            <th>{{ trans('labels.backend.trackables.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $trackable->deleted_at }} ({{ $trackable->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>