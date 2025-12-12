# DuitKu API Documentation

## 📱 REST API untuk React Native Expo

Dokumentasi lengkap API DuitKu untuk pengembangan aplikasi mobile dengan React Native Expo.

---

## 🔐 Authentication

API menggunakan **Laravel Sanctum** dengan **Bearer Token** authentication.

### Base URL
```
http://localhost:8000/api/v1
```

### Headers (untuk semua protected routes)
```javascript
{
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
```

---

## 📋 Response Format

Semua response mengikuti format standar:

### Success Response
```json
{
  "status": "success",
  "message": "Optional message",
  "data": { ... },
  "meta": { ... }  // untuk pagination
}
```

### Error Response
```json
{
  "status": "error",
  "message": "Error description"
}
```

### Validation Error (422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

---

## 🔑 Auth Endpoints

### POST /auth/register
Registrasi user baru.

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (201):**
```json
{
  "status": "success",
  "message": "Registration successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "token": "1|abc123xyz..."
  }
}
```

**React Native Usage:**
```javascript
const register = async (name, email, password) => {
  const response = await fetch(`${API_URL}/auth/register`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: JSON.stringify({
      name,
      email,
      password,
      password_confirmation: password,
    }),
  });
  
  const data = await response.json();
  if (data.status === 'success') {
    // Save token to AsyncStorage
    await AsyncStorage.setItem('token', data.data.token);
    await AsyncStorage.setItem('user', JSON.stringify(data.data.user));
  }
  return data;
};
```

---

### POST /auth/login
Login dan dapatkan token.

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "status": "success",
  "message": "Login berhasil",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "token": "1|abc123xyz..."
  }
}
```

**Error Response (401):**
```json
{
  "status": "error",
  "message": "Email atau password salah"
}
```

---

### POST /auth/logout 🔒
Logout (revoke current token).

**Response (200):**
```json
{
  "status": "success",
  "message": "Logout berhasil"
}
```

---

### GET /auth/user 🔒
Get data user yang login.

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

---

## 📊 Dashboard Endpoints

### GET /dashboard 🔒
Get semua data dashboard sekaligus (stats, recent transactions, budget overview).

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "stats": {
      "income": 10000000,
      "expense": 5000000,
      "balance": 5000000,
      "count": 25,
      "income_change": 15.5,
      "expense_change": -10.2
    },
    "recent_transactions": [...],
    "budget_overview": [...],
    "chart_data": {...}
  }
}
```

---

### GET /dashboard/stats 🔒
Get statistics saja.

**Query Parameters:**
| Parameter | Type | Description | Default |
|-----------|------|-------------|---------|
| period | string | week, month, year | month |

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "income": 10000000,
    "expense": 5000000,
    "balance": 5000000,
    "count": 25
  }
}
```

---

## 💰 Transaction Endpoints

### GET /transactions 🔒
Get semua transaksi dengan filter dan pagination.

**Query Parameters:**
| Parameter | Type | Description | Default |
|-----------|------|-------------|---------|
| type | string | income / expense | - |
| category_id | integer | Filter by category | - |
| period | string | today, week, month, 30days, all | all |
| search | string | Search di description | - |
| per_page | integer | Items per page | 15 |
| page | integer | Page number | 1 |

**Response (200):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "type": "expense",
      "amount": 150000,
      "formatted_amount": "Rp 150.000",
      "description": "Makan siang",
      "notes": "Di restoran favorit",
      "date": "2025-12-12",
      "formatted_date": "12 Des 2025",
      "category": {
        "id": 1,
        "name": "Makanan",
        "icon": "🍔",
        "color": "from-orange-500 to-red-500"
      }
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 75
  }
}
```

**React Native Usage:**
```javascript
const getTransactions = async (filters = {}) => {
  const token = await AsyncStorage.getItem('token');
  const params = new URLSearchParams(filters).toString();
  
  const response = await fetch(`${API_URL}/transactions?${params}`, {
    headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ${token}`,
    },
  });
  
  return await response.json();
};

// Example usage
const data = await getTransactions({
  type: 'expense',
  period: 'month',
  per_page: 20,
});
```

---

### POST /transactions 🔒
Buat transaksi baru.

**Request Body:**
```json
{
  "type": "expense",
  "amount": 150000,
  "description": "Makan siang",
  "category_id": 1,
  "date": "2025-12-12",
  "notes": "Di restoran favorit"
}
```

**Response (201):**
```json
{
  "status": "success",
  "message": "Transaksi berhasil ditambahkan",
  "data": {
    "id": 1,
    "type": "expense",
    "amount": 150000,
    "description": "Makan siang",
    "date": "2025-12-12",
    "category_id": 1
  }
}
```

---

### GET /transactions/{id} 🔒
Get single transaction.

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "type": "expense",
    "amount": 150000,
    "formatted_amount": "Rp 150.000",
    "description": "Makan siang",
    "notes": "Di restoran",
    "date": "2025-12-12",
    "formatted_date": "12 Des 2025",
    "category": {...}
  }
}
```

---

### PUT /transactions/{id} 🔒
Update transaksi.

**Request Body (partial update allowed):**
```json
{
  "amount": 175000,
  "description": "Makan siang update"
}
```

---

### DELETE /transactions/{id} 🔒
Hapus transaksi.

**Response (200):**
```json
{
  "status": "success",
  "message": "Transaksi berhasil dihapus"
}
```

---

### GET /transactions-stats 🔒
Get transaction statistics.

**Query Parameters:**
| Parameter | Type | Default |
|-----------|------|---------|
| period | string | month |

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "income": 10000000,
    "expense": 5000000,
    "balance": 5000000,
    "count": 25
  }
}
```

---

## 📁 Category Endpoints

### GET /categories 🔒
Get semua kategori.

**Query Parameters:**
| Parameter | Type | Description |
|-----------|------|-------------|
| type | string | income / expense |

**Response (200):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Makanan",
      "type": "expense",
      "type_label": "Pengeluaran",
      "icon": "🍔",
      "color": "from-orange-500 to-red-500",
      "transaction_count": 15,
      "total_amount": 750000
    }
  ]
}
```

---

### POST /categories 🔒
Buat kategori baru.

**Request Body:**
```json
{
  "name": "Makanan",
  "type": "expense",
  "icon": "🍔",
  "color": "from-orange-500 to-red-500"
}
```

---

### PUT /categories/{id} 🔒
Update kategori.

---

### DELETE /categories/{id} 🔒
Hapus kategori.

---

### GET /categories-breakdown 🔒
Get spending/income breakdown by category.

**Query Parameters:**
| Parameter | Type | Default |
|-----------|------|---------|
| type | string | expense |
| year | integer | current year |
| month | integer | current month |

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "total": 5000000,
    "items": [
      {
        "id": 1,
        "name": "Makanan",
        "icon": "🍔",
        "color": "from-orange-500 to-red-500",
        "spent": 750000,
        "percentage": 15
      }
    ]
  }
}
```

---

## 💵 Budget Endpoints

### GET /budgets 🔒
Get semua budget dengan info spending.

**Response (200):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "category": {
        "id": 1,
        "name": "Makanan",
        "icon": "🍔",
        "color": "from-orange-500 to-red-500"
      },
      "amount": 2000000,
      "formatted_amount": "Rp 2.000.000",
      "spent": 750000,
      "formatted_spent": "Rp 750.000",
      "remaining": 1250000,
      "formatted_remaining": "Rp 1.250.000",
      "percentage": 37.5,
      "period": "monthly",
      "period_label": "Bulanan",
      "start_date": "2025-12-01",
      "alert_threshold": 80,
      "is_exceeded": false,
      "is_over_threshold": false
    }
  ]
}
```

---

### POST /budgets 🔒
Buat budget baru.

**Request Body:**
```json
{
  "category_id": 1,
  "amount": 2000000,
  "period": "monthly",
  "start_date": "2025-12-01",
  "alert_threshold": 80
}
```

**Period options:** `weekly`, `monthly`, `yearly`

---

### PUT /budgets/{id} 🔒
Update budget.

**Request Body:**
```json
{
  "amount": 2500000,
  "alert_threshold": 75
}
```

---

### DELETE /budgets/{id} 🔒
Hapus budget.

---

### GET /budgets-summary 🔒
Get budget summary.

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "total_budget": 5000000,
    "total_spent": 2500000,
    "total_remaining": 2500000,
    "budget_count": 4,
    "exceeded_count": 1,
    "available_categories": [
      {"id": 5, "name": "Hiburan", "icon": "🎮"}
    ]
  }
}
```

---

## 📈 Report Endpoints

### GET /reports 🔒
Get laporan lengkap.

**Query Parameters:**
| Parameter | Type | Default |
|-----------|------|---------|
| year | integer | current year |
| month | integer | current month |

**Response (200):**
```json
{
  "status": "success",
  "data": {
    "stats": {...},
    "category_breakdown": {...},
    "daily_trend": [...],
    "income_vs_expense": [...],
    "available_months": [
      {"year": 2025, "month": 12, "label": "Desember 2025"}
    ]
  }
}
```

---

### GET /reports/monthly 🔒
Get monthly statistics.

---

### GET /reports/category-breakdown 🔒
Get category breakdown untuk report.

---

### GET /reports/daily-trend 🔒
Get daily spending trend.

**Response (200):**
```json
{
  "status": "success",
  "data": [
    {"day": 1, "income": 0, "expense": 150000},
    {"day": 2, "income": 10000000, "expense": 50000},
    ...
  ]
}
```

---

## 🛠️ React Native Integration

### API Service (services/api.js)
```javascript
import AsyncStorage from '@react-native-async-storage/async-storage';

const API_URL = 'http://10.0.2.2:8000/api/v1'; // Android Emulator
// const API_URL = 'http://localhost:8000/api/v1'; // iOS Simulator

class ApiService {
  async getToken() {
    return await AsyncStorage.getItem('token');
  }

  async request(endpoint, options = {}) {
    const token = await this.getToken();
    
    const config = {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...(token && { 'Authorization': `Bearer ${token}` }),
        ...options.headers,
      },
      ...options,
    };

    if (options.body && typeof options.body === 'object') {
      config.body = JSON.stringify(options.body);
    }

    const response = await fetch(`${API_URL}${endpoint}`, config);
    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || 'Request failed');
    }

    return data;
  }

  // Auth
  async login(email, password) {
    const data = await this.request('/auth/login', {
      method: 'POST',
      body: { email, password },
    });
    await AsyncStorage.setItem('token', data.data.token);
    await AsyncStorage.setItem('user', JSON.stringify(data.data.user));
    return data;
  }

  async logout() {
    await this.request('/auth/logout', { method: 'POST' });
    await AsyncStorage.multiRemove(['token', 'user']);
  }

  // Dashboard
  async getDashboard() {
    return await this.request('/dashboard');
  }

  // Transactions
  async getTransactions(params = {}) {
    const query = new URLSearchParams(params).toString();
    return await this.request(`/transactions?${query}`);
  }

  async createTransaction(data) {
    return await this.request('/transactions', {
      method: 'POST',
      body: data,
    });
  }

  async deleteTransaction(id) {
    return await this.request(`/transactions/${id}`, {
      method: 'DELETE',
    });
  }

  // Categories
  async getCategories(type = null) {
    const query = type ? `?type=${type}` : '';
    return await this.request(`/categories${query}`);
  }

  // Budgets
  async getBudgets() {
    return await this.request('/budgets');
  }

  // Reports
  async getReports(year, month) {
    return await this.request(`/reports?year=${year}&month=${month}`);
  }
}

export default new ApiService();
```

### Usage in Components
```javascript
import api from '../services/api';

// In your component
const [transactions, setTransactions] = useState([]);
const [loading, setLoading] = useState(true);

useEffect(() => {
  loadTransactions();
}, []);

const loadTransactions = async () => {
  try {
    const response = await api.getTransactions({ period: 'month' });
    setTransactions(response.data);
  } catch (error) {
    Alert.alert('Error', error.message);
  } finally {
    setLoading(false);
  }
};

const handleDelete = async (id) => {
  try {
    await api.deleteTransaction(id);
    setTransactions(prev => prev.filter(t => t.id !== id));
  } catch (error) {
    Alert.alert('Error', error.message);
  }
};
```

---

## 📝 Notes untuk Developer

1. **Base URL untuk Emulator:**
   - Android: `http://10.0.2.2:8000/api/v1`
   - iOS: `http://localhost:8000/api/v1`
   - Real device: Gunakan IP address laptop (contoh: `http://192.168.1.100:8000/api/v1`)

2. **Token Storage:** Simpan token di AsyncStorage setelah login

3. **Error Handling:** Semua error response memiliki format yang sama dengan `status: "error"`

4. **Pagination:** Gunakan `meta.last_page` untuk load more functionality

5. **Date Format:** Selalu gunakan format `Y-m-d` (contoh: `2025-12-12`)

6. **Amount:** Kirim sebagai number, tidak perlu format currency
