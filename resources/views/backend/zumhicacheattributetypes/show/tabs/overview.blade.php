<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.name') }}</th>
        <td>{{ $zumhicacheattributetype->name }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.attribute_id') }}</th>
        <td>{{ $attribute }}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.hasYesOption') }}</th>
        <td>{!! $zumhicacheattributetype->hasYesOption ? 'YES' : 'NO' !!}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.hasNoOption') }}</th>
        <td>{!! $zumhicacheattributetype->hasNoOption ? 'YES' : 'NO' !!}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.yesIconUrl') }}</th>
        <td>{!! $zumhicacheattributetype->yesIconUrl !!}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.noIconUrl') }}</th>
        <td>{!! $zumhicacheattributetype->noIconUrl !!}</td>
    </tr>
    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.notChosenIconUrl') }}</th>
        <td>{!! $zumhicacheattributetype->notChosenIconUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicacheattributetype->created_at }} ({{ $zumhicacheattributetype->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicacheattributetype->updated_at }} ({{ $zumhicacheattributetype->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicacheattributetype->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicacheattributetypes.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicacheattributetype->deleted_at }} ({{ $zumhicacheattributetype->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>