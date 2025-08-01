// lib/echo.js
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

// Make Pusher globally available (required by Laravel Echo)
window.Pusher = Pusher

// Function to get token from localStorage
const getAuthToken = () => {
  return localStorage.getItem('auth_token') // Ensure this is set after login
}

// Create Echo instance
const echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
  encrypted: true,

  // Auth for private channels
  authorizer: (channel, options) => {
    return {
      authorize: (socketId, callback) => {
        const token = getAuthToken()

        fetch(`${import.meta.env.VITE_API_BASE_URL}/broadcasting/auth`, {
          method: 'POST',
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
            Accept: 'application/json'
          },
          body: JSON.stringify({
            socket_id: socketId,
            channel_name: channel.name
          })
        })
          .then(response => {
            if (!response.ok) {
              throw new Error(`Auth error: ${response.statusText}`)
            }
            return response.json()
          })
          .then(data => {
            callback(false, data)
          })
          .catch(error => {
            console.error('🔒 Echo authorization error:', error)
            callback(true, error)
          })
      }
    }
  },

  // Support WebSocket and Secure WebSocket
  enabledTransports: ['ws', 'wss']
})

// Log Pusher connection status
echo.connector.pusher.connection.bind('connected', () => {
  console.log('✅ Pusher connected')
})

echo.connector.pusher.connection.bind('disconnected', () => {
  console.log('❌ Pusher disconnected')
})

echo.connector.pusher.connection.bind('error', (err) => {
  console.error('🚨 Pusher connection error:', err)
})

export default echo
