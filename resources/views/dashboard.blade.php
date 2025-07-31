@extends('layouts.template')

@section('content')
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Felicitations {{ Auth::user()->name }}! 🎉 </h5>
                                            <p class="mb-4">
                                                <!-- Vous etes connectées <span class="fw-bold">72%</span> more sales today. Check your new badge in -->
                                                Vous etes connectées sur l'application en tant que {{ Auth::user()->usertype }}
                                            </p>

                                        <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img src="{{ url('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-4 order-1">
                  
                        </div> -->
                        @if(Auth::user()->usertype === 'Admin')
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/cc-success.png') }}" alt="credit_card_success" class="rounded"/>
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Budget Total</span>
                                            <h3 class="card-title mb-2">{{ $budgetTotal }} F CFA</h3>
                                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/cc-success.png') }}" alt="credit_card_success" class="rounded" />
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Budget 1er Semestre</span>
                                            <h3 class="card-title mb-2">{{ $budgetPremierSemestre }}F CFA</h3>
                                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/cc-success.png') }}" alt="depenses_total" class="rounded" />
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Budget 2eme Semestre</span>
                                            <h3 class="card-title mb-2">{{ $budgetDeuxiemeSemestre }} F CFA</h3>
                                            {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="depenses_total" class="rounded" />
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Depenses Total</span>
                                            <h3 class="card-title mb-2">{{ $depensesTotal }} F CFA</h3>
                                            {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="depenses_semestre" class="rounded" />
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Depenses 1er Semestre</span>
                                            <h3 class="card-title mb-2">{{ $depensesPremierSemestre }} F CFA </h3>
                                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="depenses_semestre" class="rounded" />
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <span class="fw-semibold d-block mb-3">Depenses 2eme Semestre</span>
                                            <h3 class="card-title mb-2">{{ $depensesDeuxiemeSemestre }}F CFA </h3>
                                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                        
                        <div class="row">
                            <div class="col-lg-3 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('assets/img/icons/unicons/wallet-info.png') }}" alt="credit_card_success" class="rounded"/>
                                            </div>
                                            {{-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <span class="fw-semibold d-block mb-3">Nombre Auditeurs</span>
                                        <h4 class="card-title mb-2">{{ $auditeurTotal }}</h4>
                                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('assets/img/icons/unicons/wallet-info.png') }}" alt="credit_card_success" class="rounded" />
                                            </div>
                                            {{-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <span class="fw-semibold d-block mb-3">Nombre de Formation</span>
                                        <h3 class="card-title mb-2">{{ $formationTotal }}</h3>
                                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('assets/img/icons/unicons/wallet-info.png') }}" alt="depenses_total" class="rounded" />
                                            </div>
                                            {{-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <span class="fw-semibold d-block mb-3">Nombre Session</span>
                                        <h3 class="card-title mb-2">{{ $sessionTotal }}</h3>
                                        {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-6 mb-4">
                                {{-- <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('assets/img/icons/unicons/paypal.png') }}" alt="depenses_semestre" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-3">Depenses Semestriel</span>
                                        <h3 class="card-title mb-2">{{ $depensesPremierSemestre }} F CFA </h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- / Content -->
@endsection