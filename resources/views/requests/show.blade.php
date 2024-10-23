@inject('city','App\Models\City')
@inject('bloodType','App\Models\BloodType')
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation Request') }} for  <span class=" text-red">{{$record->patient_name}}</span>
        </h2>
    </x-slot>

    <x-slot name=''></x-slot>

    
                    <x-content-wrapper>
                        <x-slot name='body'>
                            <section class="content">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Request Detail</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <div class="row">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-light">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center text-muted">Blood Type</span>
                                                                <span class="info-box-number text-center text-red mb-0">
                                                                    {{$bloodType::find($record->blood_type_id)->name}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-light">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center text-muted">Bags Number</span>
                                                                <span class="info-box-number text-center text-blue mb-0">{{$record->bags_num}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="info-box bg-light">
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-center text-muted">City</span>
                                                                <span class="info-box-number text-center text-green mb-0">{{$city::find($record->city_id)->name}}</span>
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
                                                                        <p class="card-title"> <i class="fas fa-address-card"></i> Patient </p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                <p class="text-muted">Name: <span class="text-primary">{{$record->patient_name}}</span></p>
                                                                                <p class="text-muted">Age: <span class="text-primary">{{$record->patient_age}}</span></p>
                                                                                <p class="text-muted">Phone: <span class="text-primary">{{$record->patient_phone}}</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <!-- Hospital Details Card -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p class="card-title"><i class="fas fa-hospital"></i> Hospital Details</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Add hospital details here -->
                                                        <p class="text-muted">Hospital Name: <span class="text-primary">{{$record->hospital_name}}</span></p>
                                                        <p class="text-muted">Address: <span class="text-primary">{{$record->hospital_address}}</span></p>
                                                       
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
