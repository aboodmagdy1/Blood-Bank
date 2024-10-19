@inject('roleModel','Spatie\Permission\Models\Role' )
@inject('permissionModel','Spatie\Permission\Models\Permission' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User ') }}  :  <span class=" text-red">{{$record->name}}</span>
        </h2>
    </x-slot>

    <x-slot name=''></x-slot>

    
                    <x-content-wrapper>
                        <x-slot name='body'>
                            <section class="content">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">User Details </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <div class="row">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-light">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center text-muted">Name</span>
                                                                <span class="info-box-number text-center text-red mb-0">
                                                                   {{$record->name}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-light">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center text-muted">Email</span>
                                                                <span class="info-box-number text-center text-blue mb-0">{{$record->email}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="post">
                                                            <div class="user-block">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <p class="card-title"> <i class="fas fa-address-card"></i> Roles </p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                @foreach ($record->roles as $role)
                                                                                    <span class="badge badge-info">{{$role->name}}</span>
                                                                                    
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="post">
                                                            <div class="user-block">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <p class="card-title"> <i class="fas fa-address-card"></i> Permissions </p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                @foreach ($record->permissions as $permission)
                                                                                    <span class="badge badge-info">{{$permission->display_name}}</span>
                                                                                    
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
        
        
                                <a href="{{route('donation-request.index')}}" class="btn btn-primary">Back</a>
                            </section>
                        </x-slot>
                    </x-content-wrapper>
   
</x-app-layout>
