<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.referenceCode') }}</th>
        <td>{!! $trackablelog->referenceCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.trackableCode') }}</th>
        <td>{!! $trackablelog->trackableCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.ownerCode') }}</th>
        <td>{!! $trackablelog->ownerCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.zumhiCode') }}</th>
        <td>{!! $trackablelog->zumhiCode !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.zumhicacheName') }}</th>
        <td>{!! $zumhicacheName !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.trackableLogTypeId') }}</th>
        <td>{!! $trackableLogType !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.coordinates') }}</th>
        <td>{!! $coordinates !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.loggedDate') }}</th>
        <td>{!! $trackablelog->loggedDate !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.text') }}</th>
        <td>{!! $trackablelog->text !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.isRot13Encoded') }}</th>
        <td>{!! $trackablelog->isRot13Encoded ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.isEncoded') }}</th>
        <td>{!! $trackablelog->isEncoded ? 'YES' : 'NO' !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.trackingNumber') }}</th>
        <td>{!! $trackablelog->trackingNumber !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.url') }}</th>
        <td>{!! $trackablelog->url !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.created_at') }}</th>
        <td>{{ $trackablelog->created_at }} ({{ $trackablelog->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.last_updated') }}</th>
        <td>{{ $trackablelog->updated_at }} ({{ $trackablelog->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($trackablelog->trashed())
        <tr>
            <th>{{ trans('labels.backend.trackablelogs.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $trackablelog->deleted_at }} ({{ $trackablelog->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>