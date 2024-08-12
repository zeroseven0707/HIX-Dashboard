import io from 'socket.io-client';
import Swal from 'sweetalert2';

const apiKey = window.sessionStorage.getItem('apiKey');
console.log('API Key:', apiKey);  // Debugging: Check if API key is correctly retrieved

const socket = io('wss://tedy-dev.my.id', {
    extraHeaders: {
        'api-key': apiKey
    }
});

socket.on('connect', () => {
    console.log('Successfully connected to WebSocket server');
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
