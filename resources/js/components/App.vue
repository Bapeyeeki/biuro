<template>
  
    <div class="font-sans min-h-screen bg-gradient-to-b from-gray-900 to-black text-white">
      <!-- Navigation -->
      <nav class="bg-black/70 backdrop-blur-sm border-b border-gray-800 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <div class="text-blue-400 text-3xl">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="text-3xl font-bold tracking-wider text-white">
              <span class="text-blue-400">Arris</span>Agency
            </div>
          </div>
          <div class="flex space-x-6 ml-auto">
            <!-- Przyciski dla niezalogowanych użytkowników -->
            <div v-if="!isLoggedIn" class="flex space-x-6">
              <button @click="showLoginModal = true" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-none shadow-md hover:shadow-lg transition-all duration-300 text-sm font-medium flex items-center no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Logowanie
              </button>
              <button @click="showRegisterModal = true" class="px-5 py-2.5 bg-transparent hover:bg-gray-800 text-white border border-blue-500 hover:border-blue-600 rounded-none shadow-md hover:shadow-lg transition-all duration-300 text-sm font-medium flex items-center no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Rejestracja
              </button>
            </div>
            
            <!-- Przyciski dla zalogowanych użytkowników -->
            <div v-else class="flex space-x-6 items-center">
              <div class="text-white">
                Witaj, <span class="font-medium">{{ currentUser.name }}</span>
              </div>
              <button @click="logout" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-none shadow-md hover:shadow-lg transition-all duration-300 text-sm font-medium flex items-center no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Wyloguj
              </button>
            </div>
          </div>
        </div>

      </nav>
  
      <!-- Hero section dla niezalogowanych -->
      <div v-if="!isLoggedIn" class="bg-gradient-to-r from-blue-900/30 to-purple-900/30 py-16">
        <div class="max-w-7xl mx-auto px-6">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">Profesjonalne przestrzenie biurowe</h1>
          <p class="text-xl text-gray-300 max-w-2xl">
            Odkryj idealne miejsce dla Twojego biznesu w centrum miasta. Nowoczesne, w pełni wyposażone biura gotowe do wynajęcia.
          </p>
        </div>
      </div>
      
      <!-- Panel użytkownika po zalogowaniu -->
      <div v-else class="bg-gradient-to-r from-blue-900/30 to-purple-900/30 py-12">
        <div class="max-w-7xl mx-auto px-6">
          <div class="bg-gray-800/70 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-700">
              <h2 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Panel użytkownika
              </h2>
            </div>
            <div class="p-6">
              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-300 mb-4">Twoje dane</h3>
                    <div class="space-y-3">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Imię i nazwisko: <span class="text-white font-medium">{{ currentUser.name }}</span></span>
                      </div>
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Email: <span class="text-white font-medium">{{ currentUser.email }}</span></span>
                      </div>
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Data rejestracji: <span class="text-white font-medium">{{ new Date(currentUser.created_at).toLocaleDateString('pl-PL') }}</span></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div>
                  <div class="bg-gray-900/60 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-lg font-medium text-white mb-4">Twoje biura</h3>
                    <div v-if="false" class="space-y-4">
                      <!-- Tu będzie lista wynajętych biur -->
                    </div>
                    <div v-else class="text-center py-8">
                      <div class="w-16 h-16 rounded-full bg-blue-600/20 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </div>
                      <h4 class="text-xl font-medium text-blue-400 mb-2">Brak wynajętych biur</h4>
                      <p class="text-gray-400 text-sm mb-4">Nie masz jeszcze wynajętych biur. Przeglądaj dostępne biura poniżej.</p>
                      <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 w-full">
                        Przeglądaj biura
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Main content -->
      <main class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
          <!-- Floor plan section -->
          <div class="bg-gray-800/50 rounded-xl shadow-2xl border border-gray-700 mb-12 overflow-hidden">
            <div class="p-6 border-b border-gray-700">
              <h2 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                Plan biura
              </h2>
            </div>
            <div class="relative p-4">
              <div class="rounded-lg overflow-hidden">
                <img
                  src="/public/Arris.png"
                  alt="Plan biura"
                  class="w-full h-auto object-contain"
                />
              </div>
  
              <!-- Interactive office markers -->
              <div
                v-for="office in offices"
                :key="office.id"
                :style="{
                  position: 'absolute',
                  top: office.y + '%',
                  left: office.x + '%',
                  transform: 'translate(-50%, -50%)',
                  zIndex: 10
                }"
                @click="selectOffice(office)"
                class="group"
              >
                <div
                  style="width: 60px; height: 60px;"
                  :class="[
                    'rounded-full border-3 flex items-center justify-center cursor-pointer transition-all duration-300',
                    selectedOffice && selectedOffice.id === office.id ? 'scale-125 shadow-lg shadow-blue-500/50' : '',
                    office.isRented 
                      ? 'bg-red-600/80 border-red-400 hover:bg-red-500' 
                      : 'bg-emerald-500/80 border-emerald-400 hover:bg-emerald-400'
                  ]"
                >
                </div>
                <!-- Tooltip -->
                <div class="opacity-0 group-hover:opacity-100 absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 transition-opacity duration-300 w-44 pointer-events-none z-20">
                  <div class="bg-white text-black text-sm rounded-md p-3 shadow-lg border border-gray-300 text-center">
                    <div class="font-bold text-base mb-1 !text-black text-center" style="color: black !important;">{{ office.name }}</div>
                    <div :class="[office.isRented ? 'text-red-400 font-medium' : 'text-emerald-400 font-medium', 'text-center']">
                      {{ office.isRented ? 'Zajęte' : 'Dostępne' }}
                    </div>
                    <div class="text-gray-400 text-xs mt-1 text-center">{{ office.size }} m²</div>
                  </div>
                  <div class="w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-white mx-auto"></div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Office details section -->
          <div id="office-details-section" v-if="selectedOffice" class="bg-gray-800/50 rounded-xl shadow-2xl border border-gray-700 mb-12 overflow-hidden">
            <div class="p-6 border-b border-gray-700 flex justify-between items-center">
              <h2 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                {{ selectedOffice.name }}
              </h2>
              <div :class="selectedOffice.isRented ? 'bg-red-600/20 text-red-400' : 'bg-emerald-600/20 text-emerald-400'" class="px-4 py-1 rounded-full font-medium">
                {{ selectedOffice.isRented ? 'Zajęte' : 'Dostępne' }}
              </div>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-6">
              <div>
                <div class="mb-6">
                  <h3 class="text-lg font-medium text-gray-300 mb-2">Szczegóły biura</h3>
                  <div class="space-y-2">
                    <div class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 0h-4m4 0l-5-5" />
                      </svg>
                      <span>Powierzchnia: {{ selectedOffice.size }} m²</span>
                    </div>
                    <div class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      <span>Pojemność: {{ selectedOffice.capacity }} osób</span>
                    </div>
                    <div class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                      </svg>
                      <span>Piętro: {{ selectedOffice.floor }}</span>
                    </div>
                    <div class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <span>Cena: {{ selectedOffice.price }} PLN/miesiąc</span>
                    </div>
                  </div>
                </div>
                
                <div class="mb-6">
                  <h3 class="text-lg font-medium text-gray-300 mb-2">Wyposażenie</h3>
                  <div class="grid grid-cols-2 gap-2">
                    <div v-for="(available, index) in selectedOffice.amenities" :key="index" class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                      </svg>
                      <span>{{ available }}</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div>
                <div class="bg-gray-900/60 p-6 rounded-lg border border-gray-700 h-full">
                  <h3 class="text-lg font-medium text-white mb-4">Zapytaj o dostępność</h3>
                  <div v-if="!selectedOffice.isRented">
                    <div class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Imię i nazwisko</label>
                        <input type="text" class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Jan Kowalski" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="jan.kowalski@example.com" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Telefon</label>
                        <input type="tel" class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="+48 123 456 789" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Data rozpoczęcia</label>
                        <input type="date" class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                      </div>
                      <button @click="rentOffice" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 border border-gray-700">
                        Wyślij zapytanie
                      </button>
                    </div>
                  </div>
                  <div v-else class="flex flex-col items-center justify-center h-full text-center space-y-3 py-2">
                    <div class="w-16 h-16 rounded-full bg-red-600/20 flex items-center justify-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </div>
                    <h4 class="text-xl font-medium text-red-400">Biuro obecnie zajęte</h4>
                    <p class="text-gray-400 text-sm">To biuro jest obecnie wynajęte. Sprawdź inne dostępne biura lub skontaktuj się z nami.</p>
                    <button class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 border border-gray-700 w-full mx-auto mb-4">
                      Zapytaj o dostępność
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Available offices grid -->
          <div class="bg-gray-800/50 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-700">
              <h2 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Lista biur
              </h2>
            </div>
            <div class="p-6">
              <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div 
                  v-for="office in offices" 
                  :key="office.id"
                  class="bg-gray-900/60 rounded-lg border border-gray-700 overflow-hidden hover:border-blue-500 transition duration-300 cursor-pointer"
                  @click="selectOffice(office)"
                >
                  <div class="p-5">
                    <div class="flex justify-between items-start mb-4">
                      <h3 class="text-xl font-bold text-white">{{ office.name }}</h3>
                      <div :class="office.isRented ? 'bg-red-600/20 text-red-400' : 'bg-emerald-600/20 text-emerald-400'" class="px-2 py-1 rounded-full text-xs font-medium">
                        {{ office.isRented ? 'Zajęte' : 'Dostępne' }}
                      </div>
                    </div>
                    <div class="space-y-2 text-sm">
                      <div class="flex items-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 0h-4m4 0l-5-5" />
                        </svg>
                        <span>{{ office.size }} m²</span>
                      </div>
                      <div class="flex items-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Do {{ office.capacity }} osób</span>
                      </div>
                      <div class="flex items-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ office.price }} PLN/miesiąc</span>
                      </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-700">
                      <button @click="selectOffice(office)" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 border border-gray-700">
                        {{ office.isRented ? 'Zobacz szczegóły' : 'Sprawdź dostępność' }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
  
      <!-- Footer -->
      <footer class="bg-black/70 py-8 mt-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6">
          <div class="grid md:grid-cols-4 gap-8">
            <div>
              <div class="text-2xl font-bold tracking-wider text-white mb-4">
                <span class="text-blue-400">Arris</span>Agency
              </div>
              <p class="text-gray-400 mb-4">
                Nowoczesne przestrzenie biurowe dostosowane do potrzeb Twojego biznesu.
              </p>
              <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                  </svg>
                </a>
              </div>
            </div>
            <div>
              <h3 class="text-lg font-bold mb-4 text-white">Kontakt</h3>
              <ul class="space-y-2 text-gray-400">
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span>ul. Armii Krajowej 9A, 41-506 Chorzów</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  <span>kontakt@arris.pl</span>
                </li>
                <li class="flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  <span>+48 691 661 859</span>
                </li>
              </ul>
            </div>
          </div>
  
          <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-gray-500 text-center">
            <p>&copy; {{ new Date().getFullYear() }} ArrisAgency. Wszelkie prawa zastrzeżone.</p>
          </div>
        </div>
      </footer>

      <!-- Login Modal -->
      <div v-if="showLoginModal" class="modal-backdrop">
        <div class="modal-container bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 overflow-hidden animate-fade-in-up">
          <div class="p-6 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Logowanie</h3>
            <button @click="showLoginModal = false; document.body.style.overflow = 'auto';" class="text-gray-400 hover:text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="p-6">
            <form @submit.prevent="login">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                  <input v-model="loginData.email" type="email" class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="twoj@email.com" required />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Hasło</label>
                  <input v-model="loginData.password" type="password" class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="••••••••" required />
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-600 rounded checkbox-input" />
                    <label for="remember" class="ml-2 block text-sm text-gray-300">Zapamiętaj mnie</label>
                  </div>
                  <button @click="forgotPassword" class="text-sm text-blue-400 hover:text-blue-300">Zapomniałeś hasła?</button>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 modal-submit-btn">
                  Zaloguj się
                </button>
              </div>
            </form>
            <div class="mt-6 text-center text-sm text-gray-400">
              Nie masz jeszcze konta? 
              <button 
                @click="switchToRegister" 
                class="text-blue-400 hover:text-blue-300 font-medium"
                type="button"
              >
                Zarejestruj się
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Register Modal -->
      <div v-if="showRegisterModal" class="modal-backdrop">
        <div class="modal-container bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 overflow-hidden animate-fade-in-up">
          <div class="p-6 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Rejestracja</h3>
            <button @click="showRegisterModal = false; document.body.style.overflow = 'auto';" class="text-gray-400 hover:text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="p-6">
            <form @submit.prevent="register">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Imię i nazwisko</label>
                  <input type="text" class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Jan Kowalski" required />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                  <input type="email" class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="twoj@email.com" required />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Hasło</label>
                  <input 
                    v-model="password" 
                    type="password" 
                    class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="••••••••" 
                    required 
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Powtórz hasło</label>
                  <input 
                    v-model="confirmPassword" 
                    @input="checkPasswordsMatch" 
                    type="password" 
                    class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    :class="{'border-red-500 focus:border-red-500 focus:ring-red-500': !passwordsMatch}" 
                    placeholder="••••••••" 
                    required 
                  />
                  <p v-if="!passwordsMatch" class="text-red-500 text-sm mt-1">Hasła muszą być identyczne</p>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="terms" class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-600 rounded checkbox-input" required />
                  <label for="terms" class="ml-2 block text-sm text-gray-300">
                    Akceptuję <a href="#" class="text-blue-400 hover:text-blue-300">regulamin</a> i <a href="#" class="text-blue-400 hover:text-blue-300">politykę prywatności</a>
                  </label>
                </div>
                <button 
                  type="submit" 
                  class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 modal-submit-btn"
                  :class="{'opacity-50 cursor-not-allowed': !passwordsMatch}"
                  :disabled="!passwordsMatch"
                >
                  Zarejestruj się
                </button>
              </div>
            </form>
            <div class="mt-6 text-center text-sm text-gray-400">
              Masz już konto? 
              <button 
                @click="switchToLogin" 
                class="text-blue-400 hover:text-blue-300 font-medium"
                type="button"
              >
                Zaloguj się
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Modal -->
      <div v-if="showSuccessModal" class="modal-backdrop">
        <div class="modal-container bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 overflow-hidden animate-fade-in-up">
          <div class="p-6">
            <div class="flex justify-center mb-6">
              <div class="w-16 h-16 rounded-full bg-emerald-600/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
            <h3 class="text-2xl font-bold text-center text-white mb-2">Dziękujemy!</h3>
            <p class="text-gray-300 text-center mb-6">
              Zgłoszenie zostało wysłane. Skontaktujemy się z Tobą wkrótce w celu omówienia szczegółów najmu.
            </p>
            <div class="flex justify-center">
              <button @click="showSuccessModal = false; document.body.style.overflow = 'auto';" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-md transition duration-300 border border-gray-700">
                Zamknij
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Forgot Password Modal -->
      <div v-if="showForgotPasswordModal" class="modal-backdrop">
        <div class="modal-container bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 overflow-hidden animate-fade-in-up">
          <div class="p-6 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Resetowanie hasła</h3>
            <button @click="showForgotPasswordModal = false" class="text-gray-400 hover:text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="p-6">
            <form @submit.prevent="resetPassword">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                  <input type="email" class="w-full bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="twoj@email.com" required />
                </div>
                <p class="text-sm text-gray-400">
                  Podaj adres email powiązany z Twoim kontem. Wyślemy Ci link do zresetowania hasła.
                </p>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 modal-submit-btn">
                  Wyślij link resetujący
                </button>
              </div>
            </form>
            <div class="mt-6 text-center text-sm text-gray-400">
              Przypomniałeś sobie hasło? 
              <button 
                @click="switchFromForgotPasswordToLogin" 
                class="text-blue-400 hover:text-blue-300 font-medium"
                type="button"
              >
                Wróć do logowania
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Registration Success Modal -->
      <div v-if="showRegistrationSuccessModal" class="modal-backdrop">
        <div class="modal-container bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 overflow-hidden animate-fade-in-up">
          <div class="p-6">
            <div class="flex justify-center mb-6">
              <div class="w-16 h-16 rounded-full bg-emerald-600/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
            <h3 class="text-2xl font-bold text-center text-white mb-2">Witaj w naszym gronie!</h3>
            <p class="text-gray-300 text-center mb-6">
              Twoje konto zostało pomyślnie utworzone. Możesz teraz zalogować się i korzystać ze wszystkich funkcji naszej platformy.
            </p>
            <div class="flex justify-center">
              <button @click="switchFromRegistrationSuccessToLogin" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                Przejdź do logowania
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue'
  import axios from 'axios'

  // Konfiguracja axios
  axios.defaults.withCredentials = true
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

  // Mobile menu state removed
  
  // Auth states
  const isLoggedIn = ref(false)
  const currentUser = ref(null)

  // Modal states
  const showSuccessModal = ref(false)
  const showLoginModal = ref(false)
  const showRegisterModal = ref(false)
  const showForgotPasswordModal = ref(false)
  const showRegistrationSuccessModal = ref(false)
  
  // Selected office
  const selectedOffice = ref(null)
  
  // Form data
  const password = ref('')
  const confirmPassword = ref('')
  const passwordsMatch = ref(true)
  const loginData = ref({ email: '', password: '' })
  const registerData = ref({ name: '', email: '', password: '', password_confirmation: '' })

  // Enhanced office data
  const offices = ref([
    { 
      id: 1, 
      name: 'Biuro A', 
      x: 14, 
      y: 15, 
      isRented: false,
      size: 12,
      capacity: 6,
      floor: 1,
      price: 900,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia']
    },
    { 
      id: 2, 
      name: 'Biuro B', 
      x: 32, 
      y: 15, 
      isRented: true,
      size: 6,
      capacity: 3,
      floor: 1,
      price: 480,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Monitoring']
    },
    { 
      id: 3, 
      name: 'Biuro C', 
      x: 55, 
      y: 15, 
      isRented: false,
      size: 18,
      capacity: 9,
      floor: 1,
      price: 1260,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Kuchnia']
    },
    { 
      id: 4, 
      name: 'Biuro D', 
      x: 27, 
      y: 70, 
      isRented: false,
      size: 11,
      capacity: 5,
      floor: 1,
      price: 880,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Recepcja']
    },
    { 
      id: 5, 
      name: 'Biuro E', 
      x: 55, 
      y: 70, 
      isRented: true,
      size: 17,
      capacity: 8,
      floor: 1,
      price: 1190,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe']
    },
    { 
      id: 6, 
      name: 'Biuro F', 
      x: 85, 
      y: 70, 
      isRented: false,
      size: 13,
      capacity: 6,
      floor: 1,
      price: 1040,
      amenities: ['Internet światłowodowy', 'Klimatyzacja', 'Dostęp 24/7', 'Meble biurowe', 'Sala konferencyjna', 'Kuchnia', 'Parking']
    },
  ])
  
  // Select office function
  function selectOffice(office) {
    selectedOffice.value = office
    // Scroll to details section with form
    setTimeout(() => {
      const detailsSection = document.querySelector('#office-details-section')
      if (detailsSection) {
        window.scrollTo({
          top: detailsSection.offsetTop - 80,
          behavior: 'smooth'
        })
      }
    }, 100)
  }
  
  // Rent office function
  function rentOffice() {
    if (selectedOffice.value && !selectedOffice.value.isRented) {
      selectedOffice.value.isRented = true
      showSuccessModal.value = true
    }
  }
  
  // Login function
  async function login() {
    try {
      const response = await axios.post('/api/login', loginData.value)
      console.log('Zalogowano:', response.data)
      currentUser.value = response.data.user
      isLoggedIn.value = true
      showLoginModal.value = false
      // Resetujemy dane formularza logowania
      loginData.value = { email: '', password: '' }
    } catch (error) {
      console.error('Błąd logowania:', error.response.data)
      alert('Błąd logowania: ' + (error.response?.data?.message || 'Nieprawidłowe dane logowania'))
    }
  }
  // Logout function
  async function logout() {
    try {
      await axios.post('/api/logout')
      currentUser.value = null
      isLoggedIn.value = false
    } catch (error) {
      console.error('Błąd wylogowania:', error)
    }
  }

  // Forgot password function
  function forgotPassword() {
    showLoginModal.value = false
    setTimeout(() => {
      showForgotPasswordModal.value = true
    }, 300)
  }
  
  // Reset password function
  function resetPassword() {
    // In a real app, this would send a password reset email
    showForgotPasswordModal.value = false
    document.body.style.overflow = 'auto' // Odblokuj przewijanie
    // Here you would handle the password reset logic
    console.log('Password reset email sent')
  }
  
  // Check if passwords match
  function checkPasswordsMatch() {
    passwordsMatch.value = password.value === confirmPassword.value
    return passwordsMatch.value
  }
  
  // Register function
  async function register() {
  try {
    const response = await axios.post('/api/register', registerData.value)
    console.log('Zarejestrowano:', response.data)
    showRegisterModal.value = false
    showRegistrationSuccessModal.value = true
  } catch (error) {
    console.error('Błąd rejestracji:', error.response?.data || error.message)
  }
}
  
  // Watch modals to toggle body scroll
  function watchModals() {
    if (showLoginModal.value || showRegisterModal.value || showSuccessModal.value || 
        showForgotPasswordModal.value || showRegistrationSuccessModal.value) {
      document.body.style.overflow = 'hidden' // Zablokuj przewijanie
    } else {
      document.body.style.overflow = 'auto' // Odblokuj przewijanie
    }
  }
  
  // Functions to switch between modals
  function switchToRegister() {
    showLoginModal.value = false
    setTimeout(() => {
      showRegisterModal.value = true
    }, 300)
  }
  
  function switchToLogin() {
    showRegisterModal.value = false
    setTimeout(() => {
      showLoginModal.value = true
    }, 300)
  }
  
  function switchFromForgotPasswordToLogin() {
    showForgotPasswordModal.value = false
    setTimeout(() => {
      showLoginModal.value = true
    }, 300)
  }
  
  function switchFromRegistrationSuccessToLogin() {
    showRegistrationSuccessModal.value = false
    setTimeout(() => {
      showLoginModal.value = true
    }, 300)
  }
  
  // Check if user is logged in on page load
  async function checkAuth() {
    try {
      const response = await axios.get('/api/user')
      if (response.data) {
        currentUser.value = response.data
        isLoggedIn.value = true
      }
    } catch (error) {
      console.error('Nie zalogowano:', error)
      isLoggedIn.value = false
    }
  }

  // Call checkAuth on component mount
  onMounted(() => {
    checkAuth()
  })

  // Watch for modal changes
  watch(showLoginModal, watchModals)
  watch(showRegisterModal, watchModals)
  watch(showSuccessModal, watchModals)
  watch(showForgotPasswordModal, watchModals)
  watch(showRegistrationSuccessModal, watchModals)
  
  // Watch for password changes
  watch(password, checkPasswordsMatch)
  watch(confirmPassword, checkPasswordsMatch)
  </script>
  
  <style>
  /* Global styles */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
  
  body {
  font-family: 'Inter', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #0f172a;
  color: #f1f5f9;
}

.min-h-screen {
  min-height: 100vh;
}

.bg-gradient-to-b {
  background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
}

.from-gray-900 {
  --tw-gradient-from: #111827;
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(17, 24, 39, 0));
}

.to-black {
  --tw-gradient-to: #000000;
}

nav {
  background-color: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid #1e293b;
  position: sticky;
  top: 0;
  z-index: 50;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.flex {
  display: flex;
}

.items-center {
  align-items: center;
}

.justify-between {
  justify-content: space-between;
}

.max-w-7xl {
  max-width: 70rem;
}

.mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.px-6 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.py-5 {
  padding-top: 1rem;
  padding-bottom: 1rem;
}

.space-x-2 > * + * {
  margin-left: 0.5rem;
}

.text-3xl {
  font-size: 1.5rem;
  line-height: 2rem;
}

.text-2xl {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

.font-bold {
  font-weight: 700;
}

.tracking-wider {
  letter-spacing: 0.05em;
}

.text-blue-400 {
  color: #60a5fa;
}

.text-white {
  color: #ffffff;
}

.inline {
  display: inline;
}

.text-gray-300 {
  color: #cbd5e1;
}

.text-gray-400 {
  color: #94a3b8;
}

.hidden {
  display: none;
}

.md\\:flex {
  display: flex;
}

.space-x-1 > * + * {
  margin-left: 0.25rem;
}

.px-4 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.rounded-md {
  border-radius: 0.375rem;
}

.transition {
  transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 200ms;
}

.duration-300 {
  transition-duration: 200ms;
}

.font-medium {
  font-weight: 500;
}

.bg-gradient-to-r {
  background-image: linear-gradient(to right, var(--tw-gradient-stops));
}


.py-16 {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

.text-4xl {
  font-size: 2rem;
  line-height: 2.25rem;
}

.md\\:text-5xl {
  font-size: 2.5rem;
  line-height: 1.25;
}

.mb-4 {
  margin-bottom: 0.75rem;
}

.text-xl {
  font-size: 1.125rem;
  line-height: 1.5rem;
}

.max-w-2xl {
  max-width: 40rem;
}

.py-12 {
  padding-top: 2.5rem;
  padding-bottom: 2.5rem;
}

.mb-12 {
  margin-bottom: 2rem;
}

.rounded-xl {
  border-radius: 0.75rem;
}

.shadow-2xl {
  box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.25);
}

.border {
  border-width: 1px;
}

.border-gray-700 {
  border-color: #334155;
}

.overflow-hidden {
  overflow: hidden;
}

.p-6 {
  padding: 1rem;
}

.border-b {
  border-bottom-width: 1px;
}

.mr-2 {
  margin-right: 0.25rem;
}

.h-6 {
  height: 1.25rem;
}

.w-6 {
  width: 1.25rem;
}

.relative {
  position: relative;
}

.p-4 {
  padding: 0.75rem;
}

.bg-black {
  background-color: #000000;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.w-full {
  width: 100%;
}

.h-auto {
  height: auto;
}

.object-contain {
  object-fit: contain;
}

.grid {
  display: grid;
}

.md\\:grid-cols-2 {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

.lg\\:grid-cols-3 {
  grid-template-columns: repeat(3, minmax(0, 1fr));
}

.gap-6 {
  gap: 1rem;
}

.hover\\:border-blue-500:hover {
  border-color: #3b82f6;
}

.cursor-pointer {
  cursor: pointer;
}

.flex-col {
  flex-direction: column;
}

.justify-center {
  justify-content: center;
}

.h-full {
  height: 100%;
}

.text-center {
  text-align: center;
}

.space-y-4 > * + * {
  margin-top: 0.75rem;
}

.w-16 {
  width: 3.5rem;
}

.h-16 {
  height: 3.5rem;
}

.rounded-full {
  border-radius: 9999px;
}



.h-8 {
  height: 2rem;
}

.w-8 {
  width: 2rem;
}

.text-red-400 {
  color: #f87171;
}



.text-emerald-400 {
  color: #34d399;
}

.office-area {
  transition: fill 0.3s ease;
  cursor: pointer;
}

.office-area:hover {
  fill: rgba(59, 130, 246, 0.5);
}

.office-area.available {
  fill: rgba(16, 185, 129, 0.5);
  stroke: #10b981;
}

.office-area.rented {
  fill: rgba(239, 68, 68, 0.5);
  stroke: #ef4444;
}

.office-area.selected {
  fill: rgba(59, 130, 246, 0.7);
  stroke: #3b82f6;
  stroke-width: 3;
}

.office-label {
  font-weight: bold;
  font-size: 12px;
  fill: white;
  pointer-events: none;
}

.details-panel {
  background-color: rgba(31, 41, 55, 0.8);
  border: 1px solid #334155;
  border-radius: 0.75rem;
  padding: 1rem;
  margin-top: 1.5rem;
}

.detail-row {
  display: flex;
  margin-bottom: 0.5rem;
  align-items: center;
}

.detail-icon {
  color: #60a5fa;
  margin-right: 0.5rem;
}

.detail-label {
  min-width: 120px;
  color: #94a3b8;
}

.detail-value {
  font-weight: 500;
}

.btn {
  display: inline-block;
  padding: 0.5rem 1rem;
  font-weight: 600;
  border-radius: 0.375rem;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-primary {
  background-color: #2563eb;
  color: white;
}

.btn-primary:hover {
  background-color: #1d4ed8;
}

.btn-danger {
  background-color: #dc2626;
  color: white;
}

.btn-danger:hover {
  background-color: #b91c1c;
}

.btn-gray {
  background-color: #4b5563;
  color: white;
}

.btn-gray:hover {
  background-color: #374151;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 100;
  padding: 1rem;
}

.modal-content {
  background-color: #1f2937;
  border-radius: 0.5rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  max-width: 400px;
  width: 100%;
  border: 1px solid #374151;
  overflow: hidden;
}

.modal-header {
  padding: 1rem;
  border-bottom: 1px solid #374151;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.modal-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: white;
}

.modal-body {
  padding: 1.25rem;
}

.modal-footer {
  padding: 0.75rem;
  border-top: 1px solid #374151;
  display: flex;
  justify-content: flex-end;
  gap: 0.75rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-label {
  display: block;
  margin-bottom: 0.25rem;
  font-size: 0.875rem;
  font-weight: 500;
  color: #d1d5db;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: #f9fafb;
  background-color: #374151;
  border: 1px solid #4b5563;
  border-radius: 0.375rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  border-color: #3b82f6;
  outline: none;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

@media (min-width: 768px) {
  .md\\:flex {
    display: flex;
  }

  .md\\:hidden {
    display: none;
  }
}

/* Nadpisanie stylów ikon */
svg.h-3, svg.h-4, svg.h-5, svg.h-8, svg.h-10 {
  width: 12px !important;
  height: 12px !important;
}

/* Ikony w modalach */
.modal-container svg.h-6 {
  width: 24px !important;
  height: 24px !important;
}

/* Naprawienie białych pasków na przyciskach i formularzach */
input, button, select, textarea {
  appearance: none !important;
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  outline: none !important;
  box-shadow: none !important;
  border-radius: 0.375rem !important;
}

input[type="date"], input[type="text"], input[type="email"], input[type="tel"] {
  background-color: #1f2937 !important;
  color: white !important;
  border: 1px solid #374151 !important;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  filter: invert(1);
}

/* Style dla przycisków i linków */
button {
  background-color: #1f2937 !important;
  border: 1px solid #374151 !important;
  color: white !important;
}

/* Usunięcie podkreślenia z linków i kwadratowe przyciski */
a {
  text-decoration: none !important;
}

.no-underline {
  text-decoration: none !important;
}

.rounded-none {
  border-radius: 0 !important;
}

/* Nadpisanie stylów dla przycisków w nawigacji */
nav a.px-5, nav button.px-5 {
  border-radius: 0 !important;
  text-decoration: none !important;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
}

/* Animacje dla modali */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.3s ease-out forwards;
}

/* Style dla modali */
[v-cloak] {
  display: none;
}

.modal-backdrop {
  position: fixed !important;
  top: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  left: 0 !important;
  z-index: 9999 !important;
  background-color: rgba(0, 0, 0, 0.85) !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 1rem !important;
}

.modal-container {
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
  width: 100%;
  max-width: 28rem;
  box-sizing: border-box !important;
}

.modal-container > div {
  box-sizing: border-box !important;
  width: 100% !important;
}

.modal-container form {
  width: 100% !important;
}

.modal-container .space-y-4 > div {
  width: 100% !important;
  box-sizing: border-box !important;
  margin-right: 0 !important;
  padding-right: 0 !important;
}

/* Style dla kontenerów checkboxów */
.modal-container .flex.items-center {
  display: flex !important;
  align-items: center !important;
  width: auto !important;
}

.modal-container .flex.items-center label {
  margin-left: 0.25rem !important;
  display: inline !important;
}

/* Specjalne style dla kontenerów checkboxów w formularzu */
.modal-container .space-y-4 > .flex.items-center {
  display: flex !important;
  width: 100% !important;
}

.modal-container .space-y-4 > .flex.items-center input[type="checkbox"] {
  flex-shrink: 0 !important;
  min-width: 1rem !important;
}

/* Poprawki dla przycisków w modalach */
.modal-container button {
  background-color: transparent !important;
  border: none !important;
  outline: none !important;
  cursor: pointer !important;
}

.modal-container button.text-blue-400 {
  display: inline-block !important;
  padding: 0.25rem 0.5rem !important;
  border-radius: 0.25rem !important;
  transition: all 0.2s ease !important;
}

.modal-container button.text-blue-400:hover {
  background-color: rgba(59, 130, 246, 0.1) !important;
}

.modal-submit-btn {
  background-color: #2563eb !important;
  border: none !important;
  color: white !important;
  padding: 0.75rem 1rem !important;
  border-radius: 0.375rem !important;
  font-weight: 600 !important;
  width: 100% !important;
  margin-top: 1.5rem !important;
  font-size: 1rem !important;
  letter-spacing: 0.025em !important;
}

.modal-container input {
  background-color: #374151 !important;
  border: 1px solid #4B5563 !important;
  color: white !important;
  border-radius: 0.375rem !important;
  width: 100% !important;
  padding: 0.5rem 0.75rem !important;
  box-sizing: border-box !important;
  margin-right: 0 !important;
  max-width: 100% !important;
  display: block !important;
  overflow: visible !important;
}

/* Dodatkowe style dla pól tekstowych w modalach */
.modal-container input[type="email"],
.modal-container input[type="password"],
.modal-container input[type="text"],
.modal-container input[type="tel"],
.modal-container input[type="date"] {
  width: 100% !important;
  box-sizing: border-box !important;
  display: block !important;
}

/* Style dla checkboxów */
.modal-container input[type="checkbox"] {
  width: 1rem !important;
  height: 1rem !important;
  display: inline-block !important;
  margin-right: 0.5rem !important;
  padding: 0 !important;
  appearance: auto !important;
  -webkit-appearance: checkbox !important;
  -moz-appearance: checkbox !important;
  position: relative !important;
  cursor: pointer !important;
  vertical-align: middle !important;
  opacity: 1 !important;
  z-index: 1 !important;
  background-color: white !important;
  border: 1px solid #4B5563 !important;
}

/* Specjalne style dla checkboxów z klasą checkbox-input */
.checkbox-input {
  width: 1rem !important;
  height: 1rem !important;
  display: inline-block !important;
  margin-right: 0.5rem !important;
  padding: 0 !important;
  appearance: auto !important;
  -webkit-appearance: checkbox !important;
  -moz-appearance: checkbox !important;
  position: relative !important;
  cursor: pointer !important;
  vertical-align: middle !important;
  opacity: 1 !important;
  z-index: 1 !important;
  background-color: white !important;
  border: 1px solid #4B5563 !important;
  border-radius: 0.25rem !important;
}

  </style>