<div {{ $attributes }}>
    
    <div class="wrapper" >
        <div class="content-wrapper py-12">
            <div class="content">
                <div class="container-fluid">

                    {{-- tosts  --}}
                    <x-flash-success/>
                    <x-flash-error/>
                    {{-- Content and Actions  --}}
                    <div class="row  bg-white">
                        <div class="col-lg-12">
                            <div class= "text-center overflow-hidden shadow-sm sm:rounded-lg mb-2">
                                @if (isset($actions))
                                <div class="p-6 text-gray-900">                                 
                                    {{ $actions }}
                            </div>
                                @endif
                            </div>

                            {{-- Main content of page --}}
                            {{$body ?? ""}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
