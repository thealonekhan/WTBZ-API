<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.referenceCode') }}</th>
        <td>{!! $trackablelog->referenceCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.zumhiCode') }}</th>
        <td>{!! $trackablelog->zumhiCode !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.coordinates') }}</th>
        <td>{!! $coordinates !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.isCorrectedCoordinates') }}</th>
        <td>{!! $trackablelog->isCorrectedCoordinates ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.description') }}</th>
        <td>{!! $trackablelog->description !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.created_at') }}</th>
        <td>{{ $trackablelog->created_at }} ({{ $trackablelog->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.last_updated') }}</th>
        <td>{{ $trackablelog->updated_at }} ({{ $trackablelog->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($trackablelog->trashed())
        <tr>
            <th>{{ trans('labels.backend.userwaypoints.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $trackablelog->deleted_at }} ({{ $trackablelog->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>