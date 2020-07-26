<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicachecoordinates.tabs.content.overview.latitude') }}</th>
        <td>{{ $zumhicachecoordinate->latitude }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhicachecoordinates.tabs.content.overview.longitude') }}</th>
        <td>{{ $zumhicachecoordinate->longitude }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachecoordinates.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicachecoordinate->created_at }} ({{ $zumhicachecoordinate->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicachecoordinates.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicachecoordinate->updated_at }} ({{ $zumhicachecoordinate->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicachecoordinate->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicachecoordinates.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicachecoordinate->deleted_at }} ({{ $zumhicachecoordinate->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>