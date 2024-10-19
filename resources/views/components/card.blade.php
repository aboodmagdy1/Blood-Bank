<div {{ $attributes->merge(['class' => 'col-lg-3 col-6']) }}>
    
    <a href="{{$href??"#"}}">
        <div class="small-box bg-{{ $color ?? 'primary' }}">
            <div class="inner">
                <h3>{{ $count }}</h3>
                <p>{{ $title }}</p>
            </div>
            <div class="icon">
                <i class="{{ $icon }}"></i>
            </div>
        </div>
    </a>

</div>
