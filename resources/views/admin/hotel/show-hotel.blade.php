@extends('admin.layouts.layout-admin')
@section('content-admin')

<style>
   /* Custom styles for Swiper */
   .swiper-pagination-bullet-active {
       background-color: #0ea5e9 !important;
   }
   
   /* Fade in animation for profile overlay */
   @keyframes fadeIn {
       from { opacity: 0; transform: translateY(10px); }
       to { opacity: 1; transform: translateY(0); }
   }
   
   .profile-overlay {
       animation: fadeIn 0.5s ease-out forwards;
   }
   
   /* Custom scrollbar */
   ::-webkit-scrollbar {
       width: 8px;
       height: 8px;
   }
   
   ::-webkit-scrollbar-track {
       background: #f1f1f1;
   }
   
   ::-webkit-scrollbar-thumb {
       background: #c1c1c1;
       border-radius: 4px;
   }
   
   ::-webkit-scrollbar-thumb:hover {
       background: #a1a1a1;
   }
</style>
<x-admin.dashboard-panel class="">
   
   <!-- Main Container -->
   <div x-data="hotelProfile()">
      <!-- Header Carousel Section -->
      <div class="relative">
            <!-- Full-width Carousel -->
            <div class="swiper headerSwiper h-[50vh] md:h-[60vh] lg:h-[70vh]">
               <div class="swiper-wrapper">
                  <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                           alt="Grand Hotel Exterior" 
                           class="object-cover w-full h-full">
                  </div>
                  <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                           alt="Grand Hotel Lobby" 
                           class="object-cover w-full h-full">
                  </div>
                  <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                           alt="Grand Hotel Event Hall" 
                           class="object-cover w-full h-full">
                  </div>
                  <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2025&q=80" 
                           alt="Grand Hotel Room" 
                           class="object-cover w-full h-full">
                  </div>
                  <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                           alt="Grand Hotel Pool" 
                           class="object-cover w-full h-full">
                  </div>
               </div>
               <div class="swiper-pagination"></div>
               <div class="text-white swiper-button-next"></div>
               <div class="text-white swiper-button-prev"></div>
            </div>
            
            <!-- Profile Overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent profile-overlay">
               <div class="z-[1000] container mx-auto flex flex-col md:flex-row items-end md:items-center justify-between">
                  <div class="flex items-center mb-4 md:mb-0">
                        <div class="w-20 h-20 overflow-hidden bg-white border-4 border-white rounded-full shadow-lg md:w-24 md:h-24">
                           <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2096&q=80" 
                                 alt="Grand Plaza Hotel Logo" 
                                 class="object-cover w-full h-full">
                        </div>
                        <div class="ml-4">
                           <h1 class="text-2xl font-bold text-white md:text-3xl">Grand Plaza Hotel</h1>
                           <div class="flex items-center mt-1">
                              <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="ml-1 text-white">5.0</span>
                              </div>
                              <span class="mx-2 text-white">•</span>
                              <span class="flex items-center text-white">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                                    New York, NY
                              </span>
                           </div>
                        </div>
                  </div>
                  <div class="flex space-x-2">
                        <button type="button" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                           <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                           Book Now
                        </button>
                        <button type="button" class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                           <i data-lucide="share-2" class="w-4 h-4 mr-2"></i>
                           Share
                        </button>
                  </div>
               </div>
            </div>
      </div>
      
      <!-- Dashboard Stats Section -->
      <div class="container px-4 py-8 mx-auto">
            <div class="mb-8 swiper statsSwiper">
               <div class="swiper-wrapper">
                  <!-- Total Reservations -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 bg-blue-100 rounded-full dark:bg-blue-900">
                                    <i data-lucide="calendar-check" class="w-8 h-8 text-blue-600 dark:text-blue-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Reservations</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">1,248</h3>
                                    <p class="flex items-center mt-1 text-sm text-green-600">
                                       <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                                       <span>12% increase</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  <!-- Number of Rooms -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 bg-blue-100 rounded-full dark:bg-blue-900">
                                    <i data-lucide="bed" class="w-8 h-8 text-blue-600 dark:text-blue-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hotel Rooms</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">42</h3>
                                    <p class="flex items-center mt-1 text-sm text-gray-600">
                                       <span>85% occupancy rate</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  <!-- Number of Event Halls -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 bg-purple-100 rounded-full dark:bg-purple-900">
                                    <i data-lucide="landmark" class="w-8 h-8 text-purple-600 dark:text-purple-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Event Halls</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">8</h3>
                                    <p class="flex items-center mt-1 text-sm text-gray-600">
                                       <span>3 currently available</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  <!-- Successful Bookings Overall -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 bg-green-100 rounded-full dark:bg-green-900">
                                    <i data-lucide="check-circle" class="w-8 h-8 text-green-600 dark:text-green-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Successful Bookings</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">94%</h3>
                                    <p class="flex items-center mt-1 text-sm text-green-600">
                                       <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                                       <span>3% increase</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  <!-- Room Bookings -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 rounded-full bg-amber-100 dark:bg-amber-900">
                                    <i data-lucide="hotel" class="w-8 h-8 text-amber-600 dark:text-amber-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Room Bookings</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">876</h3>
                                    <p class="flex items-center mt-1 text-sm text-green-600">
                                       <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                                       <span>8% increase</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
                  
                  <!-- Hall Bookings -->
                  <div class="swiper-slide">
                        <div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                           <div class="flex items-center">
                              <div class="p-3 mr-4 rounded-full bg-rose-100 dark:bg-rose-900">
                                    <i data-lucide="party-popper" class="w-8 h-8 text-rose-600 dark:text-rose-300"></i>
                              </div>
                              <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hall Bookings</p>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">372</h3>
                                    <p class="flex items-center mt-1 text-sm text-green-600">
                                       <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                                       <span>15% increase</span>
                                    </p>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
               <div class="swiper-pagination"></div>
            </div>
            
            <!-- Hotel Details Section -->
            <div class="grid grid-cols-1 gap-8 mb-8 lg:grid-cols-3">
               <div class="lg:col-span-2">
                  <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                        <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
                           <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-600"></i>
                           Hotel Details
                        </h2>
                        
                        <div class="mb-6">
                           <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Grand Plaza Hotel</h3>
                           <p class="mb-4 text-gray-700 dark:text-gray-300">
                              The Grand Plaza Hotel is a luxurious 5-star establishment located in the heart of New York City. With stunning views of Central Park and the Manhattan skyline, our hotel offers an unparalleled experience for both business and leisure travelers. Our elegant rooms and suites are designed with comfort and style in mind, featuring premium amenities and modern technology.
                           </p>
                           <p class="text-gray-700 dark:text-gray-300">
                              Our event spaces are perfect for weddings, conferences, and special occasions, with state-of-the-art facilities and dedicated event planning staff. From intimate gatherings to grand celebrations, we provide personalized service to ensure your event is a success. Our culinary team creates exquisite menus tailored to your preferences, using the finest ingredients and innovative techniques.
                           </p>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                           <div class="flex items-center">
                              <i data-lucide="phone" class="w-5 h-5 mr-2 text-blue-600"></i>
                              <span class="text-gray-700 dark:text-gray-300">+1 (212) 555-1234</span>
                           </div>
                           <div class="flex items-center">
                              <i data-lucide="mail" class="w-5 h-5 mr-2 text-blue-600"></i>
                              <span class="text-gray-700 dark:text-gray-300">manager@grandplazahotel.com</span>
                           </div>
                           <div class="flex items-center">
                              <i data-lucide="globe" class="w-5 h-5 mr-2 text-blue-600"></i>
                              <a href="#" class="text-blue-600 hover:underline">www.grandplazahotel.com</a>
                           </div>
                           <div class="flex items-center">
                              <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-blue-600"></i>
                              <span class="text-gray-700 dark:text-gray-300">123 Park Avenue, New York, NY 10022</span>
                           </div>
                        </div>
                  </div>
               </div>
               
               <div class="lg:col-span-1">
                  <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                        <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
                           <i data-lucide="plus-circle" class="w-5 h-5 mr-2 text-blue-600"></i>
                           Administration
                        </h2>
                        
                        <div class="space-y-4">
                           <button type="button" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                              <i data-lucide="bed" class="w-4 h-4 mr-2"></i>
                              Add New Room
                           </button>
                           
                           <button type="button" class="w-full text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                              <i data-lucide="landmark" class="w-4 h-4 mr-2"></i>
                              Add New Event Hall
                           </button>
                           
                           <button type="button" class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                              <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                              Hotel Settings
                           </button>
                        </div>
                        
                        <div class="mt-6">
                           <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Location</h3>
                           <div class="rounded-lg overflow-hidden h-[200px] border border-gray-200 dark:border-gray-700">
                              <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215053348743!2d-73.97686532342224!3d40.75790623646392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e4a1c884e5%3A0x24fe1071086b36d5!2sPark%20Ave%2C%20New%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sca!4v1685123456789!5m2!1sen!2sca" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                              </iframe>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
            
            <!-- Room Management Table -->
            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
               <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                  <div class="flex items-center flex-1 space-x-4">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
                           Room & Event Hall Management
                        </h5>
                  </div>
                  <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-3">
                        <div class="relative w-full md:w-64">
                           <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                              <i data-lucide="search" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                           </div>
                           <input type="text" 
                                 x-model="searchQuery" 
                                 @input="filterRooms()"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                 placeholder="Search rooms...">
                        </div>
                        <button type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                           <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                           Filter
                        </button>
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                           <i data-lucide="more-horizontal" class="w-4 h-4 mr-2"></i>
                           Actions
                        </button>
                        <div id="actionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                           <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                              <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to CSV</a>
                              </li>
                              <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to PDF</a>
                              </li>
                              <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to Text</a>
                              </li>
                           </ul>
                           <div class="py-1">
                              <a href="#" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete Selected</a>
                           </div>
                        </div>
                  </div>
               </div>
               <div class="overflow-x-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                           <tr>
                              <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                       <input id="checkbox-all" 
                                             type="checkbox" 
                                             x-model="selectAll"
                                             @click="toggleSelectAll()"
                                             class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                       <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('name')">
                                    <div class="flex items-center">
                                       Name
                                       <template x-if="sortField === 'name' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'name' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('type')">
                                    <div class="flex items-center">
                                       Type
                                       <template x-if="sortField === 'type' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'type' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('capacity')">
                                    <div class="flex items-center">
                                       Capacity
                                       <template x-if="sortField === 'capacity' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'capacity' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('price')">
                                    <div class="flex items-center">
                                       Price
                                       <template x-if="sortField === 'price' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'price' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('status')">
                                    <div class="flex items-center">
                                       Status
                                       <template x-if="sortField === 'status' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'status' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3 cursor-pointer" @click="sortBy('bookings')">
                                    <div class="flex items-center">
                                       Bookings
                                       <template x-if="sortField === 'bookings' && sortDirection === 'asc'">
                                          <i data-lucide="chevron-up" class="w-4 h-4 ml-1"></i>
                                       </template>
                                       <template x-if="sortField === 'bookings' && sortDirection === 'desc'">
                                          <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                                       </template>
                                    </div>
                              </th>
                              <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <template x-for="(room, index) in paginatedRooms" :key="room.id">
                              <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="w-4 px-4 py-3">
                                       <div class="flex items-center">
                                          <input 
                                                :id="'checkbox-' + room.id" 
                                                type="checkbox" 
                                                x-model="selectedRooms"
                                                :value="room.id"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label :for="'checkbox-' + room.id" class="sr-only">checkbox</label>
                                       </div>
                                    </td>
                                    <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       <img :src="room.image" :alt="room.name" class="w-auto h-8 mr-3 rounded">
                                       <span x-text="room.name"></span>
                                    </th>
                                    <td class="px-4 py-2">
                                       <template x-if="room.type === 'room'">
                                          <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Hotel Room</span>
                                       </template>
                                       <template x-if="room.type === 'hall'">
                                          <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Event Hall</span>
                                       </template>
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="room.capacity + ' people'"></td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="formatCurrency(room.price)"></td>
                                    <td class="px-4 py-2">
                                       <template x-if="room.status === 'available'">
                                          <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                                       </template>
                                       <template x-if="room.status === 'booked'">
                                          <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Booked</span>
                                       </template>
                                       <template x-if="room.status === 'maintenance'">
                                          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Maintenance</span>
                                       </template>
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       <div class="flex items-center">
                                          <i data-lucide="calendar" class="w-4 h-4 mr-1 text-gray-400"></i>
                                          <span x-text="room.bookings"></span>
                                       </div>
                                    </td>
                                    <td class="px-4 py-2">
                                       <button :id="'dropdown-button-' + room.id" :data-dropdown-toggle="'dropdown-' + room.id" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                          <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                       </button>
                                       <div :id="'dropdown-' + room.id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                          <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="'dropdown-button-' + room.id">
                                                <li>
                                                   <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                                      View details
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                                      Edit
                                                   </a>
                                                </li>
                                                <li>
                                                   <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                      <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                                      View bookings
                                                   </a>
                                                </li>
                                          </ul>
                                          <div class="py-1">
                                                <a href="#" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                   <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                                   Delete
                                                </a>
                                          </div>
                                       </div>
                                    </td>
                              </tr>
                           </template>
                        </tbody>
                  </table>
               </div>
               
               <!-- Pagination -->
               <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                  <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white" x-text="(currentPage - 1) * itemsPerPage + 1"></span>
                        -
                        <span class="font-semibold text-gray-900 dark:text-white" x-text="Math.min(currentPage * itemsPerPage, filteredRooms.length)"></span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredRooms.length"></span>
                  </span>
                  <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                           <button @click="prevPage()" :disabled="currentPage === 1" :class="{'opacity-50 cursor-not-allowed': currentPage === 1}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                              <span class="sr-only">Previous</span>
                              <i data-lucide="chevron-left" class="w-5 h-5"></i>
                           </button>
                        </li>
                        <template x-for="page in totalPages" :key="page">
                           <li>
                              <button @click="goToPage(page)" :class="{'text-blue-600 bg-blue-50 border-blue-300': currentPage === page}" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" x-text="page"></button>
                           </li>
                        </template>
                        <li>
                           <button @click="nextPage()" :disabled="currentPage === totalPages" :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                              <span class="sr-only">Next</span>
                              <i data-lucide="chevron-right" class="w-5 h-5"></i>
                           </button>
                        </li>
                  </ul>
               </nav>
            </div>
      </div>
   </div>
   
   <!-- Alpine.js Data -->
   <script>
      function hotelProfile() {
            return {
               // Room management data
               rooms: [
                  { id: 1, name: 'Deluxe King Room', type: 'room', capacity: 2, price: 299, status: 'available', bookings: 45, image: 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 2, name: 'Executive Suite', type: 'room', capacity: 4, price: 499, status: 'booked', bookings: 78, image: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 3, name: 'Grand Ballroom', type: 'hall', capacity: 200, price: 2500, status: 'available', bookings: 32, image: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 4, name: 'Family Room', type: 'room', capacity: 6, price: 399, status: 'maintenance', bookings: 56, image: 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 5, name: 'Conference Room A', type: 'hall', capacity: 50, price: 1200, status: 'booked', bookings: 89, image: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 6, name: 'Penthouse Suite', type: 'room', capacity: 2, price: 899, status: 'available', bookings: 23, image: 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 7, name: 'Wedding Hall', type: 'hall', capacity: 150, price: 3000, status: 'available', bookings: 41, image: 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
                  { id: 8, name: 'Standard Twin Room', type: 'room', capacity: 2, price: 199, status: 'booked', bookings: 67, image: 'https://images.unsplash.com/photo-1595576508898-0ad5c879a061?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' },
               ],
               filteredRooms: [],
               selectedRooms: [],
               selectAll: false,
               searchQuery: '',
               sortField: 'name',
               sortDirection: 'asc',
               currentPage: 1,
               itemsPerPage: 5,
               
               // Initialize
               init() {
                  this.filteredRooms = [...this.rooms];
                  this.initSwiper();
                  
                  // Initialize Lucide icons
                  lucide.createIcons();
               },
               
               // Initialize Swiper
               initSwiper() {
                  // Header carousel
                  new Swiper('.headerSwiper', {
                        loop: true,
                        autoplay: {
                           delay: 5000,
                        },
                        pagination: {
                           el: '.swiper-pagination',
                           clickable: true,
                        },
                        navigation: {
                           nextEl: '.swiper-button-next',
                           prevEl: '.swiper-button-prev',
                        },
                  });
                  
                  // Stats carousel
                  new Swiper('.statsSwiper', {
                        slidesPerView: 1,
                        spaceBetween: 16,
                        pagination: {
                           el: '.swiper-pagination',
                           clickable: true,
                        },
                        breakpoints: {
                           640: {
                              slidesPerView: 2,
                           },
                           768: {
                              slidesPerView: 3,
                           },
                           1024: {
                              slidesPerView: 4,
                           },
                        },
                  });
               },
               
               // Format currency
               formatCurrency(amount) {
                  return new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD',
                        minimumFractionDigits: 0
                  }).format(amount);
               },
               
               // Toggle select all
               toggleSelectAll() {
                  if (this.selectAll) {
                        this.selectedRooms = this.paginatedRooms.map(room => room.id);
                  } else {
                        this.selectedRooms = [];
                  }
               },
               
               // Filter rooms based on search query
               filterRooms() {
                  if (!this.searchQuery) {
                        this.filteredRooms = [...this.rooms];
                  } else {
                        const query = this.searchQuery.toLowerCase();
                        this.filteredRooms = this.rooms.filter(room => 
                           room.name.toLowerCase().includes(query) || 
                           room.type.toLowerCase().includes(query)
                        );
                  }
                  this.currentPage = 1;
               },
               
               // Sort rooms
               sortBy(field) {
                  if (this.sortField === field) {
                        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                  } else {
                        this.sortField = field;
                        this.sortDirection = 'asc';
                  }
                  
                  this.filteredRooms.sort((a, b) => {
                        let comparison = 0;
                        if (a[field] > b[field]) {
                           comparison = 1;
                        } else if (a[field] < b[field]) {
                           comparison = -1;
                        }
                        return this.sortDirection === 'desc' ? comparison * -1 : comparison;
                  });
               },
               
               // Pagination methods
               get totalPages() {
                  return Math.ceil(this.filteredRooms.length / this.itemsPerPage);
               },
               
               get paginatedRooms() {
                  const start = (this.currentPage - 1) * this.itemsPerPage;
                  const end = start + this.itemsPerPage;
                  return this.filteredRooms.slice(start, end);
               },
               
               prevPage() {
                  if (this.currentPage > 1) {
                        this.currentPage--;
                  }
               },
               
               nextPage() {
                  if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                  }
               },
               
               goToPage(page) {
                  this.currentPage = page;
               }
            };
      }
   </script>
</x-admin.dashboard-panel>