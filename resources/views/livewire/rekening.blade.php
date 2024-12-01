<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <style>
                .card {
                    transition: transform 0.3s;
                    border-radius: 15px;
                    /* Rounded corners */
                }

                .card:hover {
                    transform: scale(1.05);
                    /* Scale effect on hover */
                }

                .icon {
                    font-size: 4em;
                    /* Icon size */
                    color: white;
                    /* Icon color */
                }

                .card-title {
                    font-size: 1.5em;
                    /* Title font size */
                    font-weight: bold;
                    /* Bold title */
                    margin-bottom: 0.5em;
                    /* Space below title */
                }

                .card-text {
                    font-size: 1.1em;
                    /* Content font size */
                    margin: 0;
                    /* Remove margin */
                }

                .badge {
                    font-size: 0.9em;
                    /* Badge font size */
                    padding: 0.4em 0.6em;
                    /* Badge padding */
                }

                .card-body {
                    padding: 20px;
                    /* Card padding */
                    display: flex;
                    /* Flexbox layout */
                    align-items: center;
                    /* Vertically align items */
                    justify-content: space-between;
                    /* Space between items */
                }

                .add-account-form {
                    /* background: linear-gradient(to right, #c5d9ed, #a3c7e0); Subtle gradient background */
                    padding: 20px;
                    /* Padding for the form */
                    border-radius: 15px;
                    /* Rounded corners */
                    /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); Shadow effect for depth */
                }

                .list-accounts {
                    flex: 1;
                    /* Take remaining space */
                }

                .form-container {
                    width: 400px;
                    /* Fixed width for form container */
                }

                .add-account-btn {
                    margin-bottom: 20px;
                    /* Space below button */
                    background-color: #28a745;
                    /* Button background color */
                    color: white;
                    /* Button text color */
                }

                /* Custom tooltip styles */
                .tooltip {
                    background-color: #343a40;
                    /* Dark background */
                    color: #ffffff;
                    /* White text */
                    border-radius: 5px;
                    /* Rounded corners */
                    padding: 5px;
                    /* Padding inside the tooltip */
                }

                .tooltip::before {
                    border-top-color: #343a40;
                    /* Dark border for the arrow */
                }
            </style>
            <h3 class="text-start mb-4">Rekening</h3> <!-- Heading -->
            <!-- Flash messages -->
            @if (session()->has('message'))
                <div class="alert alert-success mt-2">{{ session('message') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <!-- Form for Adding New Account -->
                    <div class="form-container">
                        <div class="add-account-form border shadow">
                            <form wire:submit.prevent="saveAccount">
                                <div class="mb-3">
                                    <label for="accountName" class="form-label"><strong>Nama Rekening</strong></label>
                                    <input type="text" class="form-control" id="accountName" wire:model="accountName"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="bankName" class="form-label"><strong>Nama Bank</strong></label>
                                    <input type="text" class="form-control" id="bankName" wire:model="bankName"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="accountNumber" class="form-label"><strong>Nomor
                                            Rekening</strong></label>
                                    <input type="text" class="form-control" id="accountNumber"
                                        wire:model="accountNumber" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambah Rekening</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    @if (!empty($data))
                        <div class="row">
                            @foreach ($data as $account)
                                <div class="col-md-6">
                                    <div class="card mb-3 border-0 shadow"
                                        style="background: linear-gradient(to right, #1365a8, #209bff); color: white;">
                                        <div class="card-body">
                                            <div class="ms-2">
                                                <h5 class="card-title">{{ $account['nama'] }}</h5>
                                                <p class="card-text">
                                                    <strong>{{ $account['bank'] }}</strong><br>
                                                    No Rekening: <strong>{{ $account['noRekening'] }}</strong><br>
                                                    @if ($account['active'])
                                                        <span class="badge bg-light text-success mt-2">Active</span>
                                                    @else
                                                        <!-- Your tooltip element -->
                                                        <span class="badge bg-light text-danger mt-2"
                                                            style="cursor: pointer;"
                                                            wire:click="activateAccount({{ $account['id'] }})"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Activasi Rekening">Unactive</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center me-3">
                                                <i class="bi bi-bank2 icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning text-center">
                            No bank account.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('swal', (event) => {
                const data = event
                swal.fire({
                    icon: data[0]['icon'],
                    title: data[0]['title'],
                    text: data[0]['text']
                })
            })
        })
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Select alert elements
            const successAlert = document.querySelector('.alert-success');
            const errorAlert = document.querySelector('.alert-danger');

            // Function to fade out alert
            function fadeOutAlert(alertElement) {
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.style.transition = 'opacity 0.5s ease';
                        alertElement.style.opacity = '0';
                        setTimeout(() => {
                            alertElement.remove(); // Remove alert from DOM
                        }, 500); // Wait for fade-out effect to finish
                    }, 3000); // Wait for 3 seconds before starting fade out
                }
            }

            // Call fade out function for each alert type
            fadeOutAlert(successAlert);
            fadeOutAlert(errorAlert);
        });
    </script>
</div>
