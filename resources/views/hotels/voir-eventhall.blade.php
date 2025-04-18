@extends('layouts.apps')
@section('content')
     
        <div class="dashboard-main-body">
            <div class="flex-wrap gap-3 mb-24 d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-semibold">Liste des salles de fetes </h6>

                <ul class="gap-2 d-flex align-items-center">
                    <li class="fw-medium">
                        <a href="index.html" class="gap-1 d-flex align-items-center hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg icon"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Salles</li>
                </ul>
            </div>

            @if($eventHalls->isEmpty())
                <div class="alert alert-info">Aucune salle trouvée pour cet hôtel</div>
            @else

                <div class="row gy-4">
                    @foreach ($eventHalls as $hall )
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="p-0 overflow-hidden card h-100 radius-12">
                                <div class="p-24 card-body">
                                
                                    @if($hall->photo)
                                        <a href=" {{route('event-halls.show', $hall->id)}}" class="overflow-hidden w-100 max-h-194-px radius-8">
                                            <img src="{{ asset('storage/' . $hall->photo) }}" alt=""
                                                class="w-100 h-100 object-fit-cover"> 
                                        </a>
                                    @endif
                                    <div class="mt-20">
                                        <div class="flex-wrap gap-6 mb-16 d-flex align-items-center justify-content-between">
                                            <a href="blog-details-2.html"
                                                class="px-20 py-6 bg-neutral-100 rounded-pill bg-hover-neutral-300 text-neutral-600 fw-medium">{{$hall->ville->nom}}</a>
                                            <div class="gap-8 d-flex align-items-center text-neutral-500 fw-medium">
                                                <i class="ri-calendar-2-line"></i>
                                                Jan 17, 2024
                                            </div>
                                        </div>
                                        <h6 class="mb-16">
                                            <a href="blog-details.html"
                                                class="text-xl text-line-2 text-hover-primary-600 transition-2">Discover
                                                {{ $hall->nom_salle }}</a>
                                        </h6>
                                        <p class="text-line-3 text-neutral-500">{{ Str::limit($hall->description_salle, 100) }}.</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <i class="fas fa-map-marker-alt"></i> 
                                                {{ $hall->localisation }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-users"></i> 
                                                Capacité : {{ $hall->capacite }} personnes
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-euro-sign"></i> 
                                                Prix : {{ number_format($hall->prix, 2, ',', ' ') }} €
                                            </li>
                                        </ul>
                                        <a href="{{route('event-halls.show', $hall->id)}}"
                                            class="gap-8 d-flex align-items-center fw-semibold text-neutral-900 text-hover-primary-600 transition-2">
                                            voir
                                            <i class="text-xl ri-arrow-right-double-line d-flex line-height-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                

                </div>
                
                <div class="mt-4 d-flex justify-content-center">
                    {{ $eventHalls->links() }}
                </div>
            @endif
        </div>
@endsection

