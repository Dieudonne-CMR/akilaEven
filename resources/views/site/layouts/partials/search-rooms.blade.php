@php
    use App\Models\Room;
    use App\Models\Hotel;
    
    // Récupération des hôtels qui ont des chambres
    $hotels = Hotel::whereHas('rooms')->pluck('nom_hotel', 'id')->unique();
    
    // Récupération des villes où se trouvent des hôtels avec des chambres
    $villes = Hotel::whereHas('rooms')->pluck('ville')->unique()->filter();
    
    // Types de chambres
    $roomTypes = [
        'Simple' => 'Simple',
        'Double' => 'Double',
        'Triple' => 'Triple',
        'Quad' => 'Quad',
        'Queen' => 'Queen',
        'King' => 'King',
        'Twin' => 'Twin',
        'Double-double' => 'Double-double',
        'Studio' => 'Studio',
        'Suite' => 'Suite',
        'Mini Suite' => 'Mini Suite',
        'Suite Présidentielle' => 'Suite Présidentielle',
        'Appartements' => 'Appartements',
        'Chambres communicantes' => 'Chambres communicantes'
    ];
@endphp

<div class="contact-form-action">
    <form action="#" class="row" x-data="{
        destination: '',
        dateRange: '',
        roomType: '',
        showDestinationList: false,
        rooms: 0,
        adults: 0,
        children: 0,
        
        // Méthodes
        incrementRooms() { this.rooms++; },
        decrementRooms() { if (this.rooms > 0) this.rooms--; },
        incrementAdults() { this.adults++; },
        decrementAdults() { if (this.adults > 0) this.adults--; },
        incrementChildren() { this.children++; },
        decrementChildren() { if (this.children > 0) this.children--; },
        
        // Calcul des textes pluriels
        get roomsText() {
            return this.rooms === 1 ? 'Chambre' : 'Chambres';
        },
        get adultsText() {
            return this.adults === 1 ? 'Adulte' : 'Adultes';
        },
        get childrenText() {
            return this.children === 1 ? 'Enfant' : 'Enfants';
        }
    }">
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Destination / Nom de l'hôtel</label>
                <div class="form-group position-relative">
                    <span class="la la-map-marker form-icon"></span>
                    <input
                        class="form-control custom-datalist"
                        type="text"
                        name="destination"
                        placeholder="Ville ou nom d'hôtel"
                        list="destination-list"
                        x-model="destination"
                        x-on:focus="showDestinationList = true"
                        x-on:blur="showDestinationList = false"
                    />
                    <datalist id="destination-list">
                        @foreach($hotels as $hotelId => $hotelName)
                            <option value="{{ $hotelName }}">{{ $hotelName }}</option>
                        @endforeach
                        @foreach($villes as $ville)
                            <option value="{{ $ville }}">{{ $ville }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Arrivée - Départ</label>
                <div class="form-group">
                    <span class="la la-calendar form-icon"></span>
                    <input
                        class="date-range form-control"
                        type="text"
                        name="daterange"
                        placeholder="Sélectionner les dates"
                        x-model="dateRange"
                    />
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3 pe-0">
            <div class="input-box">
                <label class="label-text">Type de Chambre</label>
                <div class="form-group">
                    <select class="form-select" name="room_type" x-model="roomType">
                        <option value="">Sélectionner</option>
                        @foreach($roomTypes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-3">
            <div class="input-box">
                <label class="label-text">Invités et Chambres</label>
                <div class="form-group">
                    <div class="dropdown dropdown-contain gty-container">
                        <a
                            class="dropdown-toggle dropdown-btn border form-control d-flex align-items-center justify-content-between"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            data-bs-auto-close="outside"
                        >
                            <div>
                                <span x-text="rooms"></span> <span x-text="roomsText"></span>, 
                                <span x-text="adults"></span> <span x-text="adultsText"></span>, 
                                <span x-text="children"></span> <span x-text="childrenText"></span>
                            </div>
                            <i class="la la-angle-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-wrap p-3" style="min-width: 280px">
                            <div class="dropdown-item">
                                <div class="qty-box d-flex align-items-center justify-content-between mb-2">
                                    <label>Chambres</label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <div class="qtyDec" x-on:click="decrementRooms()">
                                            <i class="la la-minus"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="room_number"
                                            x-model="rooms"
                                            class="qty-input text-center mx-2"
                                            readonly
                                        />
                                        <div class="qtyInc" x-on:click="incrementRooms()">
                                            <i class="la la-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dropdown-item">
                                <div class="qty-box d-flex align-items-center justify-content-between mb-2">
                                    <label>Adultes</label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <div class="qtyDec" x-on:click="decrementAdults()">
                                            <i class="la la-minus"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="adult_number"
                                            x-model="adults"
                                            class="qty-input text-center mx-2"
                                            readonly
                                        />
                                        <div class="qtyInc" x-on:click="incrementAdults()">
                                            <i class="la la-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dropdown-item">
                                <div class="qty-box d-flex align-items-center justify-content-between">
                                    <label>Enfants</label>
                                    <div class="qtyBtn d-flex align-items-center">
                                        <div class="qtyDec" x-on:click="decrementChildren()">
                                            <i class="la la-minus"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="child_number"
                                            x-model="children"
                                            class="qty-input text-center mx-2"
                                            readonly
                                        />
                                        <div class="qtyInc" x-on:click="incrementChildren()">
                                            <i class="la la-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .end dropdown-contain -->
                </div>
            </div>
        </div>
        <!-- end col-lg-3 -->
        
        <div class="col-lg-12">
            <div class="pt-2 text-center btn-box">
                <button type="submit" class="theme-btn">
                    <i class="mr-1 la la-search"></i> Rechercher
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .custom-datalist {
        transition: all 0.3s;
    }
    
    .custom-datalist:focus {
        box-shadow: 0 0 0 3px rgba(40, 125, 250, 0.2);
    }
    
    .form-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
        font-size: 18px;
        color: #287dfa;
    }
    
    .form-group {
        margin-bottom: 0.5rem;
        position: relative;
    }
    
    .form-control, .form-select {
        padding-left: 40px;
        height: 50px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    
    .dropdown-btn {
        cursor: pointer;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .qtyBtn {
        display: flex;
        align-items: center;
    }
    
    .qtyDec, .qtyInc {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f5f5f5;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .qtyDec:hover, .qtyInc:hover {
        background-color: #287dfa;
        color: white;
    }
    
    .qty-input {
        width: 40px;
        border: none;
        background: transparent;
    }
    
    .btn-box {
        margin-top: 10px;
    }
</style> 