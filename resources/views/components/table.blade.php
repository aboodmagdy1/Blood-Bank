<div {{ $attributes->merge(['class' => 'table-responsive']) }}>


    <table class="table table-bordered table-striped">
        <thead>
            {{ $thead }}  {{-- Table headers passed as a slot --}}
        </thead>
        <tbody>
            {{ $tbody }}  {{-- Table body passed as a slot --}}
        </tbody>
    </table>
</div>
