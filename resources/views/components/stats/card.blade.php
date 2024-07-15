<div class="card card-stats h-100">
    <div class="card-body">
        <div class="row">
        <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">{{ $title }}</h5>
            <span class="h4 font-weight-bold mb-0">{{ $number }}</span>
        </div>
        <div class="col-auto">
            {{ $icon }}
        </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
            <span class="{{ intval($percentage) <= 0 ? 'text-danger' : 'text-success' }} mr-2">
                @if ($percentage <= 0)
                    <i class="fa fa-arrow-down"></i>
                @else
                    <i class="fa fa-arrow-up"></i>
                @endif
                {{ $percentage }}%
            </span>
            <span class="text-nowrap">{{ $metadata }}</span>
        </p>
    </div>
</div>