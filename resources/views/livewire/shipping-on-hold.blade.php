<div>
    <table id="shippingOnHoldTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shippingData as $data)
                <tr>
                    <td>{{ $data['id'] }}</td>
                    <td>{{ $data['order_number'] }}</td>
                    <td>{{ $data['customer_name'] }}</td>
                    <td>{{ $data['status'] }}</td>
                    <td><button>Take Action</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            $('#shippingOnHoldTable').DataTable();
        });
    </script>
@endpush
