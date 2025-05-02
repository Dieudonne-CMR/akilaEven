@extends('admin.layouts.layout-admin')
@section('content-admin')

<x-admin.dashboard-panel class="">
   
  <div class="" x-data="reservationDetails()">
    <!-- Header Section -->
    <header class="mb-8">
        <a href="#" class="inline-flex items-center mb-6 text-gray-600 transition-colors hover:text-blue-600 group">
            <i data-lucide="arrow-left" class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1"></i>
            Back to Reservations
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Reservation Details</h1>
    </header>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Reservation Details Section -->
        <div class="lg:col-span-1">
            <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-blue-500"></i>
                    Reservation Information
                </h2>
                
                <!-- Reservation Status -->
                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    <div class="mt-1">
                        <template x-if="reservation.status === 'completed'">
                            <span class="flex items-center px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full w-fit">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1.5"></i>
                                Completée
                            </span>
                        </template>
                        <template x-if="reservation.status === 'pending'">
                            <span class="flex items-center px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full w-fit">
                                <i data-lucide="clock" class="w-4 h-4 mr-1.5"></i>
                                En attente
                            </span>
                        </template>
                        <template x-if="reservation.status === 'cancelled'">
                            <span class="flex items-center px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full w-fit">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-1.5"></i>
                                Cancelled
                            </span>
                        </template>
                    </div>
                </div>
                
                <!-- Reservation ID -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Reservation ID</span>
                    <p class="font-medium text-gray-900" x-text="reservation.id"></p>
                </div>
                
                <!-- Check-in and Check-out -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Check-in</span>
                        <p class="font-medium text-gray-900" x-text="formatDate(reservation.checkIn)"></p>
                        <p class="text-sm text-gray-500">From 2:00 PM</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Check-out</span>
                        <p class="font-medium text-gray-900" x-text="formatDate(reservation.checkOut)"></p>
                        <p class="text-sm text-gray-500">Until 12:00 PM</p>
                    </div>
                </div>
                
                <!-- Total Price -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Total Price</span>
                    <p class="text-2xl font-bold text-blue-600" x-text="formatCurrency(reservation.totalPrice)"></p>
                </div>
                
                <!-- Payment Status -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Payment Status</span>
                    <p class="flex items-center font-medium text-gray-900">
                        <i data-lucide="check" class="w-4 h-4 mr-1.5 text-green-500"></i>
                        Paid in Full
                    </p>
                </div>
                
                <hr class="my-6 border-gray-200">
                
                <!-- Guest Information -->
                <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                    <i data-lucide="user" class="w-5 h-5 mr-2 text-blue-500"></i>
                    Guest Information
                </h3>
                
                <!-- Guest Name -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Full Name</span>
                    <p class="font-medium text-gray-900" x-text="reservation.guest.name"></p>
                </div>
                
                <!-- Contact Information -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Contact Information</span>
                    <div class="flex items-center mt-1">
                        <i data-lucide="mail" class="w-4 h-4 mr-2 text-gray-400"></i>
                        <p class="text-gray-900" x-text="reservation.guest.email"></p>
                    </div>
                    <div class="flex items-center mt-1">
                        <i data-lucide="phone" class="w-4 h-4 mr-2 text-gray-400"></i>
                        <p class="text-gray-900" x-text="reservation.guest.phone"></p>
                    </div>
                </div>
                
                <!-- Address -->
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500">Address</span>
                    <div class="flex items-start mt-1">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-400 mt-0.5"></i>
                        <p class="text-gray-900" x-text="reservation.guest.address"></p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 space-y-3">
                    <button type="button" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                        Print Reservation
                    </button>
                 {{--    <button type="button" class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                        Email Guest
                    </button> --}}
                </div>
            </div>
        </div>
        
        <!-- Event Hall Details Section -->
        <div class="lg:col-span-2">
            <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
                    <i data-lucide="home" class="w-5 h-5 mr-2 text-blue-500"></i>
                    Event Hall Details
                </h2>
                
                <!-- Image Gallery -->
                <div class="mb-6" x-data="{ activeImage: 0 }">
                    <!-- Main Image -->
                    <div class="relative mb-4 overflow-hidden rounded-lg">
                        <template x-for="(image, index) in eventHall.images" :key="index">
                            <img 
                                :src="image" 
                                :alt="eventHall.name + ' image ' + (index + 1)" 
                                class="w-full h-[300px] sm:h-[400px] object-cover rounded-lg transition-opacity duration-300"
                                :class="activeImage === index ? 'opacity-100' : 'opacity-0 absolute inset-0'"
                            >
                        </template>
                        
                        <!-- Navigation Arrows -->
                        <button 
                            @click="activeImage = (activeImage - 1 + eventHall.images.length) % eventHall.images.length" 
                            class="absolute p-2 text-white transition-all -translate-y-1/2 rounded-full left-2 top-1/2 bg-black/50 hover:bg-black/70"
                        >
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>
                        <button 
                            @click="activeImage = (activeImage + 1) % eventHall.images.length" 
                            class="absolute p-2 text-white transition-all -translate-y-1/2 rounded-full right-2 top-1/2 bg-black/50 hover:bg-black/70"
                        >
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                        
                        <!-- Image Counter -->
                        <div class="absolute px-3 py-1 text-sm text-white rounded-full bottom-4 right-4 bg-black/50">
                            <span x-text="activeImage + 1"></span>/<span x-text="eventHall.images.length"></span>
                        </div>
                    </div>
                    
                    <!-- Thumbnail Grid -->
                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="(image, index) in eventHall.images" :key="index">
                            <div 
                                @click="activeImage = index" 
                                class="overflow-hidden transition-all rounded-lg cursor-pointer"
                                :class="activeImage === index ? 'ring-2 ring-blue-500' : 'hover:opacity-80'"
                            >
                                <img 
                                    :src="image" 
                                    :alt="eventHall.name + ' thumbnail ' + (index + 1)" 
                                    class="object-cover w-full h-16"
                                >
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Event Hall Name and Description -->
                <div class="mb-6">
                    <h3 class="mb-2 text-2xl font-bold text-gray-900" x-text="eventHall.name"></h3>
                    <p class="text-gray-700" x-text="eventHall.description"></p>
                </div>
                
                <!-- Event Hall Details Grid -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <!-- Price -->
                    <div class="flex items-start">
                        <div class="p-2 mr-3 bg-blue-100 rounded-full">
                            <i data-lucide="tag" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Rental Price</h4>
                            <p class="text-lg font-semibold text-gray-900" x-text="formatCurrency(eventHall.price) + ' per day'"></p>
                        </div>
                    </div>
                    
                    <!-- Capacity -->
                    <div class="flex items-start">
                        <div class="p-2 mr-3 bg-blue-100 rounded-full">
                            <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Capacity</h4>
                            <p class="text-lg font-semibold text-gray-900" x-text="eventHall.capacity + ' guests'"></p>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <div class="flex items-start">
                        <div class="p-2 mr-3 bg-blue-100 rounded-full">
                            <i data-lucide="map-pin" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Location</h4>
                            <p class="text-lg font-semibold text-gray-900" x-text="eventHall.city"></p>
                            <p class="text-sm text-gray-500" x-text="eventHall.location"></p>
                        </div>
                    </div>
                    
                    <!-- Size -->
                    <div class="flex items-start">
                        <div class="p-2 mr-3 bg-blue-100 rounded-full">
                            <i data-lucide="square" class="w-5 h-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Size</h4>
                            <p class="text-lg font-semibold text-gray-900" x-text="eventHall.size + ' sq ft'"></p>
                        </div>
                    </div>
                </div>
                
                <!-- Amenities -->
                <div class="mb-6">
                    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-blue-500"></i>
                        Available Amenities
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
                        <template x-for="(amenity, index) in eventHall.amenities" :key="index">
                            <div class="flex items-center">
                                <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                                <span class="text-gray-700" x-text="amenity"></span>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="mb-6">
                    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                        <i data-lucide="map" class="w-5 h-5 mr-2 text-blue-500"></i>
                        Location Map
                    </h3>
                    
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.3059353029!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1619826381635!5m2!1sen!2s" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>
                
                <!-- Policies -->
                <div class="mb-6">
                    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
                        <i data-lucide="shield" class="w-5 h-5 mr-2 text-blue-500"></i>
                        Policies
                    </h3>
                    
                    <div class="p-4 rounded-lg bg-gray-50">
                        <div class="mb-3">
                            <h4 class="font-medium text-gray-900">Cancellation Policy</h4>
                            <p class="text-sm text-gray-700">Free cancellation up to 48 hours before check-in. Cancellations made less than 48 hours before check-in are subject to a fee equivalent to 50% of the total reservation amount.</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Special Requirements</h4>
                            <p class="text-sm text-gray-700">No smoking. No pets allowed. No parties or events without prior approval.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<!-- Alpine.js Data -->
<script>
    function reservationDetails() {
        return {
            reservation: {
                id: "RES-2023-12345",
                status: "confirmed", // confirmed, pending, cancelled
                checkIn: "2023-12-15",
                checkOut: "2023-12-17",
                totalPrice: 2500,
                guest: {
                    name: "Michael Johnson",
                    email: "michael.johnson@example.com",
                    phone: "+1 (555) 123-4567",
                    address: "123 Main Street, Apt 4B, New York, NY 10001, United States"
                }
            },
            eventHall: {
                name: "Grand Ballroom",
                description: "Our elegant Grand Ballroom is perfect for weddings, corporate events, and large celebrations. With stunning chandeliers, a spacious dance floor, and state-of-the-art sound system, this versatile space can be customized to suit your specific needs. The ballroom features large windows with city views and access to a private terrace.",
                price: 1250,
                capacity: 200,
                size: 3500,
                city: "New York, NY",
                location: "Downtown Manhattan, 5th Avenue",
                images: [
                    "https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
                    "https://images.unsplash.com/photo-1562664377-709f2c337eb2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
                    "https://images.unsplash.com/photo-1505236858219-8359eb29e329?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
                    "https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80",
                    "https://images.unsplash.com/photo-1507878866276-a947ef722fee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
                ],
                amenities: [
                    "Wi-Fi",
                    "Sound System",
                    "Projector & Screen",
                    "Stage",
                    "Dance Floor",
                    "Catering Services",
                    "Bar Services",
                    "Private Restrooms",
                    "Coat Check",
                    "Wheelchair Accessible",
                    "Parking",
                    "Outdoor Terrace"
                ]
            },
            
            // Format date to display in a readable format
            formatDate(dateString) {
                const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('en-US', options);
            },
            
            // Format currency
            formatCurrency(amount) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 0
                }).format(amount);
            }
        }
    }
</script>

<!-- Initialize Lucide Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
</x-admin.dashboard-panel>