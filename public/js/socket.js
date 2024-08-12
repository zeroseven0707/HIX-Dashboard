// Pastikan SweetAlert2 dan socket.io sudah dimuat di HTML sebelum file ini

document.addEventListener('DOMContentLoaded', () => {
    // console.log('API Key:', apiKey);

    const socket = io('wss://hixpress.online', {
        extraHeaders: {
            'api-key': apiKey
        }
    });

    socket.on('connect', () => {
        console.log('Successfully connected to WebSocket server');
        // console.log(socket);
    });

    socket.on('connect_error', (error) => {
        console.error('Connection error:', error);
    });

    socket.on('disconnect', (reason) => {
        console.log('Disconnected:', reason);
    });

    socket.on('transactionCreated', (data) => {
        console.log('Transaction created event received:', data);  // Debugging: Check the received data
        Swal.fire('New transaction created', data.transaction.id, 'success');
    });
});
