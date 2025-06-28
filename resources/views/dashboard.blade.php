<!DOCTYPE html>
<html lang="en">
<head>    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF meta tag -->    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/dashboard.css'])
    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
</head>
<body class="home-background">    <div class="container-fluid min-vh-100 d-flex p-0">
        <!-- Sidebar -->
        <div class="bg-light border-end d-flex flex-column align-items-center justify-content-between py-4 position-fixed" style="width: 17vw; min-width: 180px; max-width: 260px; height: 100vh; z-index: 1000;">
            <div class="w-100">
                <a class="navbar-brand fw-bold d-block text-center mb-4" href="/" id="navbrand-color">
                  <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-lg-6 col-md-8 col-sm-10">
                              <div class="logo-container">
                                  <!-- Logo utama -->
                                  <img src="/images/IOLOCK.png" alt="IO Lock Logo" class="img-fluid mx-auto d-block base-image">
                                  <!-- Gear animasi -->
                                  <img src="/images/Gear.png" alt="Animated Gear" class="img-fluid mx-auto d-block gear-image">
                              </div>
                          </div>
                      </div>
                  </div>
                </a>
                <div id="current-user-info" class="text-center mb-3" style="font-size: 0.95em; color: #555;"></div>                
                <ul class="nav flex-column w-100">                    
                  <li class="nav-item mb-2" id="management-user-nav">
                        <!-- Toggle Management User section -->
                        <a class="nav-link active text-dark" href="javascript:void(0)" onclick="showSection('management-user')">
                          <i class="fas fa-users-cog me-2"></i>USER MANAGEMENT</a>
                    </li>
                    <li class="nav-item mb-2" id="user-history-nav">
                        <!-- Toggle User History section -->
                        <a class="nav-link text-dark" href="javascript:void(0)" onclick="showSection('user-history')">
                          <i class="fas fa-history me-2"></i>USER HISTORY</a>
                    </li>
                    <li class="nav-item mb-2">
                        <!-- Toggle Sensor Data section -->
                        <a class="nav-link text-dark" href="javascript:void(0)" onclick="showSection('sensor-data')">
                          <i class="fas fa-thermometer-half me-2"></i>SENSOR DATA</a>
                    </li>
                </ul>
            </div>
            <div class="w-100 text-center mt-auto">
                <form method="POST" action="{{ route('logout') }}" class="w-100 text-center mt-auto" onsubmit="clearUserSession()">
                  @csrf
                  <button type="submit" class="btn btn-outline-custom btn-sm login-button w-75">
                      Logout
                  </button>
              </form>
            </div>        </div>        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column" style="margin-left: 17vw; min-width: 0; height: 100vh; overflow-y: auto;">
            <div class="container px-4 py-3" style="flex: 1;">               
                <!-- Management User Section -->
                <div class="row justify-content-center">
                    <div class="col-12 py-3" style="padding-left: 100px; padding-right: 100px;">
                        <section id="management-user" class="animated-load" style="display: block;">
                            <!-- Manual Lock Control - Moved inside management user section -->
                            <div class="row justify-content-center mb-4 mt-3">
                                <div class="col-md-8 col-lg-6">
                                    <div class="manual-control-container">
                                        <h3 class="text-center mb-3">Manual Lock Control</h3>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <!-- <span class="me-2">UNLOCK</span> -->
                                            <div class="toggle" id="manual-switch">
                                                <div class="glow-comp"></div>
                                                <div class="toggle-button">O</div>
                                                <div class="toggle-text-on"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                              <div class="table-container">
                                <!-- Entries selector and search -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2">Show</label>
                                        <select class="form-select form-select-sm me-2" id="user-entries-select" style="width: auto;">
                                            <option value="10">10</option>
                                            <option value="25" selected>25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <label>entries</label>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>NFC UID</th>
                                                <th>USERNAME</th>
                                                <th>NAME</th>
                                                <th>ROLE</th>
                                              <th>PASSWORD</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user-table-body">
                                            <!-- Data user akan diisi oleh JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination info and controls -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div id="user-pagination-info">
                                        Showing 1 to 10 of 100 entries
                                    </div>
                                    <nav aria-label="User table pagination">
                                        <ul class="pagination pagination-sm mb-0" id="user-pagination">
                                            <!-- Pagination will be generated by JavaScript -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                          </section>
                    </div>
                </div>
                  <!-- User History Section -->
                <div class="row justify-content-center mb-4">
                    <div class="col-12 py-3" style="padding-left: 100px; padding-right: 100px;">
                        <section id="user-history" class="animated-load" style="display: none;">
                            <h2 class="text-center mb-4 section-title"> Access History</h2>
                              <!-- Search Bar for NFC History -->
                            <div class="row mb-3">
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control" id="nfc-search" placeholder="Search by UID..." autocomplete="off">
                                        <button class="btn btn-outline-secondary" type="button" id="clear-nfc-search" title="Clear search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 ms-auto">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2">Show</label>
                                        <select class="form-select form-select-sm me-2" id="nfc-entries-select" style="width: auto;">
                                            <option value="10">10</option>
                                            <option value="25" selected>25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <label>entries</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="nfc-history-content">
                                <div class="alert alert-info text-center">
                                    Loading NFC access history...
                                </div>
                            </div>
                            
                            <!-- Pagination info and controls for NFC History -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div id="nfc-pagination-info">
                                    Showing 1 to 10 of 100 entries
                                </div>
                                <nav aria-label="NFC history pagination">
                                    <ul class="pagination pagination-sm mb-0" id="nfc-pagination">
                                        <!-- Pagination will be generated by JavaScript -->
                                    </ul>
                                </nav>
                            </div>
                            </section>
                          </div>
                        </div>
                        <!-- Sensor Data Section -->
                        <div class="row justify-content-center mb-4">
                          <div class="col-md-10">
                            <section id="sensor-data" class="mt-5 animated-load" style="display: none;">  <!-- Modern Gauges for Temperature and Humidity -->
                              <div class="row justify-content-center mb-4">
                                <div class="col-md-10">
                                  <h2 class="text-center mb-4 section-title">Realtime Sensor Data & History</h2>
                                  <div class="modern-gauges-container">
                                        <!-- Humidity Gauge -->
                                        <div class="gauge-card">
                                            <h4>Humidity</h4>
                                            <div class="humidity-gauge">
                                                <div class="semicircle-gauge">
                                                    <div class="gauge-fill" id="humidity-fill"></div>
                                                    <div class="gauge-cover"></div>
                                                </div>
                                                <div class="gauge-labels">
                                                    <span class="gauge-min">0%</span>
                                                    <span class="gauge-value" id="humidity-value">--.--%</span>
                                                    <span class="gauge-max">100%</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Temperature Gauge -->
                                        <div class="gauge-card">
                                            <h4>Temperature</h4>
                                            <div class="temperature-gauge">
                                                <div class="vertical-gauge">
                                                    <div class="temp-scale">
                                                        <span>60</span>
                                                        <span>40</span>
                                                        <span>20</span>
                                                        <span>0</span>
                                                        <span>-20</span>
                                                    </div>
                                                    <div class="temp-bar-container">
                                                        <div class="temp-bar" id="temp-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="temp-value" id="temperature-value">--.-°C</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div id="sensor-data-content">
                                <div class="alert alert-info text-center">
                                    Loading sensor data from Firebase...
                                </div>
                            </div>
                            
                            <!-- Pagination info and controls for Sensor Data -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div id="sensor-pagination-info">
                                    Showing 1 to 10 of 100 entries
                                </div>
                                <nav aria-label="Sensor data pagination">
                                    <ul class="pagination pagination-sm mb-0" id="sensor-pagination">
                                        <!-- Pagination will be generated by JavaScript -->
                                    </ul>
                                </nav>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing User (floating form) -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="editUserForm">
              @csrf
              @method('PUT')
              <!-- Hidden field to store original UID -->
              <input type="hidden" id="old_uid" name="old_uid">
            <div class="modal-header">
              <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                  <label for="uid" class="form-label">UID</label>
                  <!-- Remove readonly so UID can be edited -->
                  <input type="text" class="form-control" id="uid" name="uid" required>
              </div>
              <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
              <div class="mb-3">
                  <label for="akses_level" class="form-label">Role</label>
                  <input type="text" class="form-control" id="akses_level" name="akses_level" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="text" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update User</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal for Deleting User -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this user?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    <!-- Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js?v={{ time() }}"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database-compat.js?v={{ time() }}"></script>
    <script>
      // Cek autentikasi - redirect ke login jika tidak ada data autentikasi
      (function() {
        // Periksa data autentikasi di localStorage dan sessionStorage
        const username = localStorage.getItem('username') || sessionStorage.getItem('username');
        const aksesLevel = localStorage.getItem('akses_level') || sessionStorage.getItem('akses_level');
        
        // Jika tidak ada data autentikasi, alihkan ke halaman login
        if (!username || !aksesLevel) {
          alert('You are not authenticated. Redirecting to login page...');
          window.location.href = "{{ route('login') }}";
        }
      })();
      console.log('Dashboard script loaded - Version: ' + new Date().getTime());      
      
      // Pagination variables
      let userPagination = { currentPage: 1, entriesPerPage: 25, totalEntries: 0, data: [] };
      let nfcPagination = { currentPage: 1, entriesPerPage: 25, totalEntries: 0, data: [] };
      let sensorPagination = { currentPage: 1, entriesPerPage: 25, totalEntries: 0, data: [] };
      
      // Generate pagination HTML
      function generatePagination(pagination, paginationId) {
        const totalPages = Math.ceil(pagination.totalEntries / pagination.entriesPerPage);
        const currentPage = pagination.currentPage;
        let html = '';
        
        // Previous button
        html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                  <a class="page-link" href="#" onclick="changePage('${paginationId}', ${currentPage - 1})" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>`;
        
        // Page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);
        
        if (startPage > 1) {
          html += `<li class="page-item"><a class="page-link" href="#" onclick="changePage('${paginationId}', 1)">1</a></li>`;
          if (startPage > 2) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
          }
        }
        
        for (let i = startPage; i <= endPage; i++) {
          html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage('${paginationId}', ${i})">${i}</a>
                   </li>`;
        }
        
        if (endPage < totalPages) {
          if (endPage < totalPages - 1) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
          }
          html += `<li class="page-item"><a class="page-link" href="#" onclick="changePage('${paginationId}', ${totalPages})">${totalPages}</a></li>`;
        }
        
        // Next button
        html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                  <a class="page-link" href="#" onclick="changePage('${paginationId}', ${currentPage + 1})" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>`;
        
        return html;
      }
      
      // Update pagination info
      function updatePaginationInfo(pagination, infoId) {
        const start = (pagination.currentPage - 1) * pagination.entriesPerPage + 1;
        const end = Math.min(pagination.currentPage * pagination.entriesPerPage, pagination.totalEntries);
        document.getElementById(infoId).textContent = `Showing ${start} to ${end} of ${pagination.totalEntries} entries`;
      }
      
      // Change page function
      function changePage(type, page) {
        if (type === 'user') {
          userPagination.currentPage = page;
          displayUsers();
        } else if (type === 'nfc') {
          nfcPagination.currentPage = page;
          displayNFCData();
        } else if (type === 'sensor') {
          sensorPagination.currentPage = page;
          displaySensorData();
        }
      }
        // Sort NFC data function
      function sortNFCData(field, headerElement) {
        if (!window.nfcData) return;
        
        const { data, currentSort } = window.nfcData;
        let direction = 'asc';
        
        // Toggle sort direction if clicking the same header
        if (currentSort.field === field) {
          direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
        }
        
        // Sort the data
        data.sort((a, b) => {
          let valA = a[field];
          let valB = b[field];
          
          // Special handling for timestamp field
          if (field === 'timestamp') {
            // Ensure we're comparing strings for timestamp keys
            valA = valA || '';
            valB = valB || '';
          }
          // Handle string values (UID, status)
          else {
            valA = String(valA || '').toLowerCase();
            valB = String(valB || '').toLowerCase();
          }
          
          // Compare based on direction
          if (direction === 'asc') {
            return valA > valB ? 1 : valA < valB ? -1 : 0;
          } else {
            return valA < valB ? 1 : valA > valB ? -1 : 0;
          }
        });
        
        // Update current sort state
        window.nfcData.currentSort = { field, direction };
        
        // Update pagination data and reset to first page
        nfcPagination.data = data;
        nfcPagination.currentPage = 1;
        
        // Re-display with new sort order
        displayNFCData();
      }
      
      // Filter NFC data by search term
      function filterNFCData(data) {
        const searchTerm = document.getElementById('nfc-search').value.toLowerCase().trim();
        if (!searchTerm) return data;
        
        return data.filter(row => {
          return row.uid.toLowerCase().includes(searchTerm);
        });
      }
        // Sort sensor data function
      function sortSensorData(field, headerElement) {
        if (!window.sensorData) return;
        
        const { data, columns, currentSort } = window.sensorData;
        let direction = 'asc';
        
        // Toggle sort direction if clicking the same header
        if (currentSort.field === field) {
          direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
        }
        
        // Sort the data
        data.sort((a, b) => {
          let valA = a[field];
          let valB = b[field];
          
          // Special handling for timestamp field
          if (field === 'timestamp') {
            // Ensure we're comparing numbers
            valA = typeof valA === 'number' ? valA : 0;
            valB = typeof valB === 'number' ? valB : 0;
          }
          // Handle other numeric values
          else if (!isNaN(parseFloat(valA)) && !isNaN(parseFloat(valB))) {
            valA = parseFloat(valA);
            valB = parseFloat(valB);
          }
          
          // Compare based on direction
          if (direction === 'asc') {
            return valA > valB ? 1 : valA < valB ? -1 : 0;
          } else {
            return valA < valB ? 1 : valA > valB ? -1 : 0;
          }
        });
        
        // Update current sort state
        window.sensorData.currentSort = { field, direction };
        
        // Update pagination data and reset to first page
        sensorPagination.data = data;
        sensorPagination.currentPage = 1;
        
        // Re-display with new sort order
        displaySensorData();
      }
        // Toggle sections with manual control visibility
      function showSection(sectionId) {
        document.getElementById('management-user').style.display = (sectionId === 'management-user') ? 'block' : 'none';
        document.getElementById('user-history').style.display = (sectionId === 'user-history') ? 'block' : 'none';
        document.getElementById('sensor-data').style.display = (sectionId === 'sensor-data') ? 'block' : 'none';
        
        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
        document.querySelector(`a[onclick*="${sectionId}"]`).classList.add('active');
        
        // Load appropriate data based on section
        if (sectionId === 'sensor-data') {
          loadSensorData();
          
          // Set default gauge values while data loads
          setTimeout(() => {
            if (document.getElementById('temperature-value').innerText === '--.-°C') {
              updateGauges(25.0, 50.0);
            }
          }, 500);
        } else if (sectionId === 'management-user') {
          // Ensure user data is loaded when switching to management section
          loadUsers();
        } else if (sectionId === 'user-history') {
          // Load NFC history when switching to user history section
          loadLastAccess();
        }
      }
      const firebaseConfig = {
        apiKey: "AIzaSyAp46YtRQMKG7dFlu4dzNi-e90ajD2_3X4",
        authDomain: "io-lock.firebaseapp.com",
        databaseURL: "https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "io-lock",
        storageBucket: "io-lock.firebasestorage.app",
        messagingSenderId: "1066049821247",
        appId: "1:1066049821247:web:35102b5413c8066db6f68a",
        measurementId: "G-CDST6DL4D2"
      };
      // Initialize Firebase
      const app = firebase.initializeApp(firebaseConfig);
      const database = firebase.database();
      

      const manualSwitch = document.getElementById('manual-switch');
      // Initialize toggle state from Firebase
      database.ref('manual_control').once('value').then(snapshot => {
        const val = snapshot.val();
        if (val) manualSwitch.classList.add('toggle-on');
      }).catch(err => console.error('Failed to load manual_control:', err));
      // Toggle handler updates Firebase
      manualSwitch.addEventListener('click', function(e) {
        e.preventDefault();
        const isOn = manualSwitch.classList.toggle('toggle-on');
        database.ref('manual_control').set(isOn)
          .catch(err => console.error('Failed to update manual_control:', err));
      });      // Tampilkan data user
      function loadUsers() {
        database.ref('nfc_cards').once('value').then(snapshot => {
          const users = snapshot.val();
          if (users) {
            userPagination.data = Object.entries(users);
            userPagination.totalEntries = userPagination.data.length;
            displayUsers();
          } else {
            userPagination.data = [];
            userPagination.totalEntries = 0;
            displayUsers();
          }
        });
      }
      
      // Display users with pagination
      function displayUsers() {
        const tbody = document.getElementById('user-table-body');
        const startIndex = (userPagination.currentPage - 1) * userPagination.entriesPerPage;
        const endIndex = startIndex + userPagination.entriesPerPage;
        const pageData = userPagination.data.slice(startIndex, endIndex);
        
        tbody.innerHTML = '';
        if (pageData.length > 0) {
          pageData.forEach(([uid, user]) => {
            tbody.innerHTML += `
              <tr>
                <td>${uid}</td>
                <td>${user.username || ''}</td>
                <td>${user.nama || ''}</td>
                <td>${user.akses_level || ''}</td>
                <td>${user.password || ''}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-primary" onclick="showEditModal('${uid}', '${user.username || ''}', '${user.nama || ''}', '${user.akses_level || ''}', '${user.password || ''}')">Edit</button>
                  <button type="button" class="btn btn-sm btn-danger" onclick="showDeleteModal('${uid}')">Delete</button>
                </td>
              </tr>
            `;
          });
        } else {
          tbody.innerHTML = '<tr><td colspan="6" class="text-center">No user data available</td></tr>';
        }
        
        // Update pagination controls
        document.getElementById('user-pagination').innerHTML = generatePagination(userPagination, 'user');
        updatePaginationInfo(userPagination, 'user-pagination-info');
      }      // Load Last Access Data
      function loadLastAccess() {
        const lastAccessRef = database.ref('last_access');
        const content = document.getElementById('nfc-history-content');
        
        // Use on('value') to listen for real-time updates
        lastAccessRef.on('value', snapshot => {
          const data = snapshot.val();
          
          if (data) {
            console.log('Last access data:', data);
            
            // Store the parsed data for sorting
            let parsedData = [];
            
            // Check if the data structure is timestamp-based or direct
            if (typeof data === 'object' && !data.uid && !Array.isArray(data)) {
              // Handle the timestamp-based structure (newer format)
              Object.entries(data).forEach(([key, accessData]) => {
                const timeFormatted = key.replace('_', ' ').replace(/-/g, ':');
                const accessStatus = accessData.access || 'unknown';
                
                parsedData.push({
                  timestamp: key,
                  timeFormatted: timeFormatted,
                  uid: accessData.uid || '',
                  access: accessStatus
                });
              });
              
              // Sort by timestamp descending by default (newest first)
              parsedData.sort((a, b) => b.timestamp.localeCompare(a.timestamp));
              
              // Store parsed data in pagination object
              nfcPagination.data = parsedData;
              nfcPagination.totalEntries = parsedData.length;
              
              // Store the parsed data for sorting
              window.nfcData = {
                data: parsedData,
                currentSort: {
                  field: 'timestamp',
                  direction: 'desc'
                }
              };
              
              // Display data with pagination
              displayNFCData();
              
              // Add search functionality
              const searchInput = document.getElementById('nfc-search');
              const clearButton = document.getElementById('clear-nfc-search');
              
              searchInput.addEventListener('input', function() {
                displayNFCData();
              });
              
              clearButton.addEventListener('click', function() {
                searchInput.value = '';
                displayNFCData();
              });
              
            } else {
              // Legacy format fallback
              content.innerHTML = `
                <div class="table-container">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>NFC UID</th>
                          <th>Time</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>${data.uid || ''}</td>
                          <td>${data.time || ''}</td>
                          <td>-</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              `;
            }
            
            console.log('Last access data updated successfully');
          } else {
            content.innerHTML = `
              <div class="alert alert-info text-center">
                No last access data available
              </div>
            `;
            
            // Create sample data
            const timestamp = new Date().toISOString().slice(0, 10).replace(/-/g, '-') + '_' + 
                             new Date().toTimeString().slice(0, 8).replace(/:/g, '-');
            
            const sampleData = {};
            sampleData[timestamp] = {
              uid: 'C348B54F',
              access: 'denied'
            };
            
            lastAccessRef.set(sampleData).then(() => {
              console.log('Sample last access data created');
            }).catch(err => {
              console.error('Failed to create sample data:', err);
            });
          }
        }, error => {
          console.error("Error loading last access data:", error);
          content.innerHTML = `
            <div class="alert alert-danger text-center">
              Error loading data
            </div>
          `;
        });
      }
        // Display NFC data with pagination
      function displayNFCData() {
        const content = document.getElementById('nfc-history-content');
        
        // Filter data based on search
        const filteredData = filterNFCData(nfcPagination.data);
        
        // Update pagination with filtered data
        const tempPagination = {
          ...nfcPagination,
          totalEntries: filteredData.length
        };
        
        // Get paginated data
        const startIndex = (nfcPagination.currentPage - 1) * nfcPagination.entriesPerPage;
        const endIndex = startIndex + nfcPagination.entriesPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        // Generate table with sortable headers
        let html = '<div class="table-container"><div class="table-responsive"><table class="table table-striped mb-0"><thead><tr>';
        
        // Create clickable headers with sort icons - determine active header
        const currentSort = window.nfcData ? window.nfcData.currentSort : { field: 'timestamp', direction: 'desc' };
        
        html += `<th class="sortable-header${currentSort.field === 'uid' ? ' active' : ''}" data-sort="uid">NFC UID <i class="sort-icon">${currentSort.field === 'uid' ? (currentSort.direction === 'asc' ? '↑' : '↓') : ''}</i></th>`;
        html += `<th class="sortable-header${currentSort.field === 'timestamp' ? ' active' : ''}" data-sort="timestamp">Time <i class="sort-icon">${currentSort.field === 'timestamp' ? (currentSort.direction === 'asc' ? '↑' : '↓') : ''}</i></th>`;
        html += `<th class="sortable-header${currentSort.field === 'access' ? ' active' : ''}" data-sort="access">Status <i class="sort-icon">${currentSort.field === 'access' ? (currentSort.direction === 'asc' ? '↑' : '↓') : ''}</i></th>`;
        html += '</tr></thead><tbody id="nfc-data-tbody">';
        
        // Display paginated data
        pageData.forEach(row => {
          const statusClass = row.access === 'granted' ? 'text-success' : 
                             (row.access === 'denied' ? 'text-danger' : '');
          html += `
            <tr>
              <td>${row.uid}</td>
              <td>${row.timeFormatted}</td>
              <td class="${statusClass}">${row.access.toUpperCase()}</td>
            </tr>
          `;
        });
        
        html += '</tbody></table></div></div>';
        content.innerHTML = html;
        
        // Add event listeners to sortable headers
        document.querySelectorAll('#nfc-history-content .sortable-header').forEach(header => {
          header.addEventListener('click', function() {
            const sortField = this.getAttribute('data-sort');
            sortNFCData(sortField, this);
          });
        });
        
        // Update pagination controls with filtered data count
        document.getElementById('nfc-pagination').innerHTML = generatePagination(tempPagination, 'nfc');
        updatePaginationInfo(tempPagination, 'nfc-pagination-info');
      }// Function to update last access data
      function updateLastAccess(uid, accessStatus = 'granted') {
        // Generate timestamp in the format: 2025-05-14_05-35-17
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        const timestamp = `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
        
        // If no UID provided, use the current user's UID or a default
        if (!uid) {
          // Try to get current user's UID
          uid = localStorage.getItem('last_uid') || sessionStorage.getItem('last_uid') || 'C348B54F';
        }
        
        // Create the data object with timestamp as key
        const data = {};
        data[timestamp] = {
          uid: uid,
          access: accessStatus
        };
        
        // Get existing data first and then update it
        return database.ref('last_access').once('value')
          .then(snapshot => {
            const existingData = snapshot.val() || {};
            
            // Add new entry while keeping previous entries
            const updatedData = { ...existingData, ...data };
            
            // If there are too many entries, limit them (optional)
            const maxEntries = 20;
            const keys = Object.keys(updatedData).sort().reverse();
            if (keys.length > maxEntries) {
              const trimmedData = {};
              keys.slice(0, maxEntries).forEach(key => {
                trimmedData[key] = updatedData[key];
              });
              return database.ref('last_access').set(trimmedData);
            }
            
            return database.ref('last_access').update(data);
          });
      }
        window.onload = function() {
        loadUsers();
        loadLastAccess();
        
        // Add event listeners for entries selectors
        document.getElementById('user-entries-select').addEventListener('change', function() {
          userPagination.entriesPerPage = parseInt(this.value);
          userPagination.currentPage = 1;
          displayUsers();
        });
        
        document.getElementById('nfc-entries-select').addEventListener('change', function() {
          nfcPagination.entriesPerPage = parseInt(this.value);
          nfcPagination.currentPage = 1;
          displayNFCData();
        });
        
        // Update last access with current user info
        const currentUID = localStorage.getItem('last_uid') || sessionStorage.getItem('last_uid');
        if (currentUID) {
          updateLastAccess(currentUID);
        }
      };

      // Edit user
      function showEditModal(uid, username, nama, akses, password) {
        var modalEl = document.getElementById('editUserModal');
        var modal = new bootstrap.Modal(modalEl);
        document.getElementById('old_uid').value = uid;
        document.getElementById('uid').value = uid;
        document.getElementById('username').value = username;
        document.getElementById('nama').value = nama;
        document.getElementById('akses_level').value = akses;
        document.getElementById('password').value = password;
        modal.show();
      }
      document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let oldUid = document.getElementById('old_uid').value;
        let newUid = document.getElementById('uid').value;
        let data = {
          username: document.getElementById('username').value,
          nama: document.getElementById('nama').value,
          akses_level: document.getElementById('akses_level').value,
          password: document.getElementById('password').value
        };
        // Jika UID berubah, hapus data lama dan buat baru
        if (oldUid !== newUid) {
          database.ref('nfc_cards/' + oldUid).remove().then(() => {
            database.ref('nfc_cards/' + newUid).set(data).then(() => {
              loadUsers();
              bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
            });
          });
        } else {
          database.ref('nfc_cards/' + oldUid).update(data).then(() => {
            loadUsers();
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
          });
        }
      });

      // Delete user
      function showDeleteModal(uid) {
        if (confirm('Are you sure to delete this user?')) {
          database.ref('nfc_cards/' + uid).remove().then(() => {
            loadUsers();
          });
        }
      }      // Update modern gauges with the latest data
      function updateGauges(temperature, humidity) {
        // Temperature gauge (vertical bar)
        // Scale from -20 to 60 degrees (range of 80)
        const tempBar = document.getElementById('temp-bar');
        const normalizedTemp = Math.min(Math.max(temperature + 20, 0), 80); // Temperature + 20 to handle negatives, capped between 0-80
        const tempHeight = (normalizedTemp / 80) * 100;
        tempBar.style.height = tempHeight + '%';
        
        // Change color based on temperature
        if (temperature < 10) {
          tempBar.style.background = 'linear-gradient(to top, #3498db, #2980b9)'; // Cool blue
        } else if (temperature < 25) {
          tempBar.style.background = 'linear-gradient(to top, #2ecc71, #27ae60)'; // Green
        } else {
          tempBar.style.background = 'linear-gradient(to top, #f39c12, #e74c3c)'; // Orange to red
        }
        
        // Update temperature display
        document.getElementById('temperature-value').innerText = temperature.toFixed(1) + '°C';
        
        // Humidity gauge (semi-circle fill)
        // Scale from 0 to 100%
        const humidityFill = document.getElementById('humidity-fill');
        const humidityHeight = humidity;
        humidityFill.style.height = humidityHeight + '%';
        
        // Change color based on humidity
        if (humidity < 30) {
          humidityFill.style.background = 'linear-gradient(90deg, #e74c3c, #c0392b)'; // Red (dry)
        } else if (humidity < 60) {
          humidityFill.style.background = 'linear-gradient(90deg, #3498db, #2980b9)'; // Blue (normal)
        } else {
          humidityFill.style.background = 'linear-gradient(90deg, #2ecc71, #27ae60)'; // Green (humid)
        }
        
        // Update humidity display
        document.getElementById('humidity-value').innerText = humidity.toFixed(1) + '%';
      }      // Ambil dan tampilkan data sensor
      function loadSensorData() {
        const content = document.getElementById('sensor-data-content');
        
        database.ref('sensor_data').limitToLast(100).once('value').then(snapshot => {
          const data = snapshot.val();
          if (!data) {
            content.innerHTML = '<div class="alert alert-warning text-center">No sensor data available.</div>';
            return;
          }
          
          // Get latest temperature and humidity for gauges
          const dataEntries = Object.entries(data);
          if (dataEntries.length > 0) {
            const latestData = dataEntries[dataEntries.length - 1][1];
            const temperature = latestData.temperature !== undefined ? parseFloat(latestData.temperature) : 0;
            const humidity = latestData.humidity !== undefined ? parseFloat(latestData.humidity) : 0;
            
            // Update gauges with latest values
            updateGauges(temperature, humidity);
          }
          
          // Store the parsed data for sorting
          let parsedData = [];
          const firstKey = Object.keys(data)[0];
          const columns = Object.keys(data[firstKey]);
            // Parse data into a sortable array
          Object.entries(data).forEach(([key, row]) => {
            let timeStr = key;
            let timestamp = key;            if (!isNaN(Number(key))) {
              // If key is timestamp, convert to same format as access logging
              const date = new Date(Number(key));
              const year = date.getFullYear();
              const month = String(date.getMonth() + 1).padStart(2, '0');
              const day = String(date.getDate()).padStart(2, '0');
              const hours = String(date.getHours()).padStart(2, '0');
              const minutes = String(date.getMinutes()).padStart(2, '0');
              const seconds = String(date.getSeconds()).padStart(2, '0');
                // Format to match access logging: 2025-05-14 05:35:17
              timeStr = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
              console.log('Sensor time formatted from timestamp:', key, 'to:', timeStr); // Debug log
              timestamp = Number(key);
            } else {
              // If key is already in string format, format it like access logging
              timeStr = key.replace('_', ' ').replace(/-/g, ':');
              timestamp = key;
            }
            
            // Create object with all data including formatted time
            let entry = {
              timeKey: key,
              timeFormatted: timeStr,
              timestamp: timestamp,
            };
            
            // Add all sensor columns
            columns.forEach(col => {
              entry[col] = row[col] !== undefined ? row[col] : '';
            });
            
            parsedData.push(entry);
          });
          
          // Sort by timestamp descending by default (newest first)
          parsedData.sort((a, b) => b.timestamp - a.timestamp);
          
          // Store parsed data in pagination object
          sensorPagination.data = parsedData;
          sensorPagination.totalEntries = parsedData.length;
          
          // Store the parsed data for sorting
          window.sensorData = {
            columns: ['timestamp', ...columns],
            data: parsedData,
            currentSort: {
              field: 'timestamp',
              direction: 'desc'
            }
          };
          
          // Display data with pagination
          displaySensorData();
          
          // Set up real-time updates for gauges
          const latestDataRef = database.ref('sensor_data').limitToLast(1);
          latestDataRef.on('value', (snapshot) => {
            const latestData = snapshot.val();
            if (latestData) {
              const key = Object.keys(latestData)[0];
              const temperature = latestData[key].temperature !== undefined ? parseFloat(latestData[key].temperature) : 0;
              const humidity = latestData[key].humidity !== undefined ? parseFloat(latestData[key].humidity) : 0;
              
              // Update the modern gauges with real-time data
              updateGauges(temperature, humidity);
            }
          });
          
        }).catch(err => {
          console.error('Error loading sensor data:', err);
          content.innerHTML = '<div class="alert alert-danger text-center">Failed to load sensor data.</div>';
        });
      }
      
      // Display sensor data with pagination
      function displaySensorData() {
        const content = document.getElementById('sensor-data-content');
        
        // Get paginated data
        const startIndex = (sensorPagination.currentPage - 1) * sensorPagination.entriesPerPage;
        const endIndex = startIndex + sensorPagination.entriesPerPage;
        const pageData = sensorPagination.data.slice(startIndex, endIndex);
        
        const columns = window.sensorData.columns.filter(col => col !== 'timestamp');
          // Generate table with sortable headers
        let html = '<div class="table-container">';
          // Entries selector
        html += `<div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="d-flex align-items-center">
                    <label class="me-2">Show</label>
                    <select class="form-select form-select-sm me-2" id="sensor-entries-select" style="width: auto;">
                      <option value="10"${sensorPagination.entriesPerPage === 10 ? ' selected' : ''}>10</option>
                      <option value="25"${sensorPagination.entriesPerPage === 25 ? ' selected' : ''}>25</option>
                      <option value="50"${sensorPagination.entriesPerPage === 50 ? ' selected' : ''}>50</option>
                      <option value="100"${sensorPagination.entriesPerPage === 100 ? ' selected' : ''}>100</option>
                    </select>
                    <label>entries</label>
                  </div>
                </div>`;
        
        html += '<div class="table-responsive"><table class="table table-striped mb-0"><thead><tr>';
        
        // Create clickable headers with sort icons - determine active header
        const currentSort = window.sensorData ? window.sensorData.currentSort : { field: 'timestamp', direction: 'desc' };
        
        html += `<th class="sortable-header${currentSort.field === 'timestamp' ? ' active' : ''}" data-sort="timestamp">Time <i class="sort-icon">${currentSort.field === 'timestamp' ? (currentSort.direction === 'asc' ? '↑' : '↓') : ''}</i></th>`;
        columns.forEach(col => {
          html += `<th class="sortable-header${currentSort.field === col ? ' active' : ''}" data-sort="${col}">${col} <i class="sort-icon">${currentSort.field === col ? (currentSort.direction === 'asc' ? '↑' : '↓') : ''}</i></th>`;
        });
        html += '</tr></thead><tbody id="sensor-data-tbody">';
        
        // Display paginated data
        pageData.forEach(row => {
          html += `<tr><td>${row.timeFormatted}</td>`;
          columns.forEach(col => {
            html += `<td>${row[col]}</td>`;
          });
          html += '</tr>';
        });
        
        html += '</tbody></table></div></div>';
        content.innerHTML = html;
          // Add event listeners to sortable headers
        document.querySelectorAll('#sensor-data-content .sortable-header').forEach(header => {
          header.addEventListener('click', function() {
            const sortField = this.getAttribute('data-sort');
            sortSensorData(sortField, this);
          });
        });
        
        // Add entries selector change event (remove existing listeners first)
        const sensorEntriesSelect = document.getElementById('sensor-entries-select');
        if (sensorEntriesSelect) {
          // Remove any existing event listeners by cloning the element
          const newSensorEntriesSelect = sensorEntriesSelect.cloneNode(true);
          sensorEntriesSelect.parentNode.replaceChild(newSensorEntriesSelect, sensorEntriesSelect);
          
          // Add the event listener to the new element
          newSensorEntriesSelect.addEventListener('change', function() {
            console.log('Sensor entries changed to:', this.value); // Debug log
            sensorPagination.entriesPerPage = parseInt(this.value);
            sensorPagination.currentPage = 1;
            displaySensorData();
          });
        }
        
        // Update pagination controls
        document.getElementById('sensor-pagination').innerHTML = generatePagination(sensorPagination, 'sensor');
        updatePaginationInfo(sensorPagination, 'sensor-pagination-info');
      }

      // Cek akses level user saat dashboard dibuka
      window.addEventListener('DOMContentLoaded', async function() {
        let aksesLevel = localStorage.getItem('akses_level') || sessionStorage.getItem('akses_level') || '-';
        let username = localStorage.getItem('username') || sessionStorage.getItem('username') || '-';
        const infoDiv = document.getElementById('current-user-info');

        if (!username || username === 'null' || username === '-') {
          let usernameInput = sessionStorage.getItem('last_login_username') || localStorage.getItem('last_login_username');
          if (usernameInput) {
            username = usernameInput;
          } else {
            try {
              const snapshot = await database.ref('nfc_cards').once('value');
              const users = snapshot.val();
              let foundUser = null;
              if (users) {
                for (const uid in users) {
                  if (users[uid].akses_level === aksesLevel) {
                    foundUser = users[uid];
                    break;
                  }
                }
              }
              username = foundUser && foundUser.username ? foundUser.username : '-';
            } catch (error) {
              console.error('Error fetching user info:', error);
              username = '-';
            }
          }
        }

        if (infoDiv) {
          infoDiv.innerHTML = `<span><b>${username}</b> <span class='badge bg-secondary ms-1'>${aksesLevel}</span></span>`;
        }        // Role-based UI
        if (aksesLevel === 'user') {
          // Regular users: Hide management-user, show user-history and sensor-data
          document.querySelector("a.nav-link[onclick*='management-user']").parentElement.style.display = 'none';
          document.getElementById('management-user').style.display = 'none';
          showSection('user-history');
        } else {
          // Admin users: Show all sections including user-history
          showSection('management-user');
        }
      });

      // Modifikasi loginWithFirebase agar simpan akses_level ke localStorage
      async function loginWithFirebase(event) {
        event.preventDefault();
        const usernameInput = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        if (!usernameInput || !password) {
          alert("Please fill in all fields.");
          return false;
        }
        try {
          const snapshot = await database.ref('nfc_cards').once('value');
          const users = snapshot.val();
          let found = false;
          let aksesLevel = '';
          let username = '';
          for (const uid in users) {
            if (
              users[uid].username === usernameInput &&
              users[uid].password === password
            ) {
              found = true;
              aksesLevel = users[uid].akses_level || '';
              username = users[uid].username || usernameInput;
              break;
            }
          }
          if (found) {
            localStorage.setItem('akses_level', aksesLevel);
            localStorage.setItem('username', usernameInput); // PASTIKAN usernameInput yang disimpan
            sessionStorage.setItem('akses_level', aksesLevel);
            sessionStorage.setItem('username', usernameInput);
            sessionStorage.setItem('last_login_username', usernameInput);
            localStorage.setItem('last_login_username', usernameInput);
            sessionStorage.setItem('last_login_password', password);
            localStorage.setItem('last_login_password', password);
            alert("Login successful!");
            window.location.href = "{{ route('dashboard') }}";
          } else {
            alert("Username or password is incorrect.");
          }
        } catch (error) {
          console.error("Error during login:", error);
          alert("Login failed. Please try again.");
        }
        return false;
      }

      function clearUserSession() {
        localStorage.removeItem('akses_level');
        localStorage.removeItem('username');
        localStorage.removeItem('last_login_username');
        localStorage.removeItem('last_login_password');
        sessionStorage.removeItem('akses_level');
        sessionStorage.removeItem('username');
        sessionStorage.removeItem('last_login_username');
        sessionStorage.removeItem('last_login_password');
      }
    </script>
</body>
</html>