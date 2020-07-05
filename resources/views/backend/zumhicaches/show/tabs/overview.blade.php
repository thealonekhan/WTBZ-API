<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.referenceCode') }}</th>
        <td>{{ $zumhicache->referenceCode }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.name') }}</th>
        <td>{{ $zumhicache->name }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.difficulty') }}</th>
        <td>{{ $zumhicache->difficulty }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.terrain') }}</th>
        <td>{!! $zumhicache->terrain !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.placedDate') }}</th>
        <td>{!! $zumhicache->placedDate !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.publishedDate') }}</th>
        <td>{!! $zumhicache->publishedDate !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.eventEndDate') }}</th>
        <td>{!! $zumhicache->eventEndDate !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.user_id') }}</th>
        <td>{!! $user !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.type_id') }}</th>
        <td>{!! $type !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.size_id') }}</th>
        <td>{!! $size !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.country_id') }}</th>
        <td>{!! $country !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.state_id') }}</th>
        <td>{!! $state !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.ianaTimezoneId') }}</th>
        <td>{!! $zumhicache->ianaTimezoneId !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.coordinates_id') }}</th>
        <td>{!! $coordinates !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.shortDescription') }}</th>
        <td>{!! $zumhicache->shortDescription !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.longDescription') }}</th>
        <td>{!! $zumhicache->longDescription !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.hints') }}</th>
        <td>{!! $zumhicache->hints !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.relatedWebPage') }}</th>
        <td>{!! $zumhicache->relatedWebPage !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.url') }}</th>
        <td>{!! $zumhicache->url !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.isPremiumOnly') }}</th>
        <td>{!! $zumhicache->isPremiumOnly ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.containsHtml') }}</th>
        <td>{!! $zumhicache->containsHtml ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.hasSolutionChecker') }}</th>
        <td>{!! $zumhicache->hasSolutionChecker ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.status_id') }}</th>
        <td>{!! $status !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhicache->created_at }} ({{ $zumhicache->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhicache->updated_at }} ({{ $zumhicache->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhicache->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhicaches.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhicache->deleted_at }} ({{ $zumhicache->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>