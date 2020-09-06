<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.listItemName') }}</th>
        <td>{!! $listzumhicache->listItemName !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.listCode') }}</th>
        <td>{!! $listzumhicache->listCode !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.listName') }}</th>
        <td>{!! $listName !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.zumhiCode') }}</th>
        <td>{!! $listzumhicache->zumhiCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.zumhicacheName') }}</th>
        <td>{!! $zumhicacheName !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.created_at') }}</th>
        <td>{{ $listzumhicache->created_at }} ({{ $listzumhicache->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.last_updated') }}</th>
        <td>{{ $listzumhicache->updated_at }} ({{ $listzumhicache->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($listzumhicache->trashed())
        <tr>
            <th>{{ trans('labels.backend.listzumhicaches.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $listzumhicache->deleted_at }} ({{ $listzumhicache->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>