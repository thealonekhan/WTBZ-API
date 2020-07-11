<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.name') }}</th>
        <td>{{ $zumhicacheattribute->name }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.isOn') }}</th>
        <td>{!! $zumhicacheattribute->isOn ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.imageUrl') }}</th>
        <td>{!! $zumhicacheattribute->imageUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicacheattribute->created_at }} ({{ $zumhicacheattribute->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicacheattribute->updated_at }} ({{ $zumhicacheattribute->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicacheattribute->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicacheattributes.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicacheattribute->deleted_at }} ({{ $zumhicacheattribute->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>