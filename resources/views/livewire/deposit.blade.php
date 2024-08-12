  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
    <div class="table-responsive mt-2">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Total Deposit Wajib</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deposit as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item['fullName'] }}</td>
                        <td>{{ $item['totalDepositeWajib'] }}</td>
                        <td><button class="btn btn-primary" wire:click="detailDeposit('{{ $item['id'] }}')">View Detail</button></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="modal fade @if($showDetailModal2) show @endif" tabindex="-1" role="dialog" style="@if($showDetailModal2) display: block; @else display: none; @endif">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deposit Detail</h5>
                    <button type="button" class="btn btn-close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($detail)
                        <div class="container">
                            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                <div class="card-header text-center">
                                    <h4 class="card-title">{{ $detail['fullName'] }}</h4>
                                    <p class="card-subtitle text-muted">{{ $detail['contact'] }}</p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <strong>Contact:</strong> {{ $detail['contact'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Total Deposit:</strong> {{ $detail['totalDeposite'] }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                <h4>Shipping Detail</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <td>No.</td>
                                        <td>No Resi</td>
                                        <td>ongkir</td>
                                        <td>total</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @else
                        <p>No details available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    @if($detail)
                    <button type="button" class="btn btn-primary" wire:click="updateDeposit({{ $detail['id'] }})">Update</button>
                    @endif
                </div>
            </div>
        </div>
      </div>
</div>
</div>
