<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Budget;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo user
        $user = User::firstOrCreate(
            ['email' => 'demo@duitku.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        // Create income categories
        $incomeCategories = [
            ['name' => 'Gaji', 'type' => 'income', 'icon' => '💰', 'color' => 'from-green-500 to-emerald-500'],
            ['name' => 'Bonus', 'type' => 'income', 'icon' => '🎁', 'color' => 'from-teal-500 to-cyan-500'],
            ['name' => 'Freelance', 'type' => 'income', 'icon' => '💼', 'color' => 'from-blue-500 to-indigo-500'],
            ['name' => 'Investasi', 'type' => 'income', 'icon' => '📈', 'color' => 'from-purple-500 to-violet-500'],
        ];

        // Create expense categories
        $expenseCategories = [
            ['name' => 'Makanan', 'type' => 'expense', 'icon' => '🍔', 'color' => 'from-orange-500 to-red-500'],
            ['name' => 'Transport', 'type' => 'expense', 'icon' => '🚗', 'color' => 'from-blue-500 to-cyan-500'],
            ['name' => 'Belanja', 'type' => 'expense', 'icon' => '🛒', 'color' => 'from-pink-500 to-rose-500'],
            ['name' => 'Hiburan', 'type' => 'expense', 'icon' => '🎮', 'color' => 'from-purple-500 to-violet-500'],
            ['name' => 'Kesehatan', 'type' => 'expense', 'icon' => '💊', 'color' => 'from-green-500 to-emerald-500'],
            ['name' => 'Tagihan', 'type' => 'expense', 'icon' => '📄', 'color' => 'from-gray-500 to-slate-500'],
        ];

        $allCategories = array_merge($incomeCategories, $expenseCategories);
        $categoryIds = [];

        foreach ($allCategories as $cat) {
            $category = Category::firstOrCreate(
                ['name' => $cat['name'], 'user_id' => $user->id],
                array_merge($cat, ['user_id' => $user->id])
            );
            $categoryIds[$cat['name']] = $category->id;
        }

        // Create sample transactions for current month
        $now = Carbon::now();
        
        // Income transactions
        Transaction::firstOrCreate(
            ['description' => 'Gaji Desember', 'user_id' => $user->id, 'date' => $now->copy()->startOfMonth()->addDays(0)],
            [
                'user_id' => $user->id,
                'category_id' => $categoryIds['Gaji'],
                'type' => 'income',
                'amount' => 10000000,
                'description' => 'Gaji Desember',
                'date' => $now->copy()->startOfMonth()->addDays(0),
            ]
        );

        Transaction::firstOrCreate(
            ['description' => 'Bonus Akhir Tahun', 'user_id' => $user->id],
            [
                'user_id' => $user->id,
                'category_id' => $categoryIds['Bonus'],
                'type' => 'income',
                'amount' => 2500000,
                'description' => 'Bonus Akhir Tahun',
                'date' => $now->copy()->startOfMonth()->addDays(5),
            ]
        );

        // Expense transactions
        $expenses = [
            ['category' => 'Makanan', 'description' => 'Makan siang', 'amount' => 45000, 'days' => 1],
            ['category' => 'Transport', 'description' => 'Gojek ke kantor', 'amount' => 35000, 'days' => 1],
            ['category' => 'Makanan', 'description' => 'Kopi Starbucks', 'amount' => 65000, 'days' => 2],
            ['category' => 'Belanja', 'description' => 'Groceries Indomaret', 'amount' => 250000, 'days' => 3],
            ['category' => 'Hiburan', 'description' => 'Nonton Bioskop', 'amount' => 100000, 'days' => 4],
            ['category' => 'Makanan', 'description' => 'Makan malam', 'amount' => 85000, 'days' => 4],
            ['category' => 'Transport', 'description' => 'Grab', 'amount' => 42000, 'days' => 5],
            ['category' => 'Kesehatan', 'description' => 'Vitamin', 'amount' => 150000, 'days' => 6],
            ['category' => 'Tagihan', 'description' => 'Listrik PLN', 'amount' => 350000, 'days' => 7],
            ['category' => 'Belanja', 'description' => 'Online shopping', 'amount' => 450000, 'days' => 8],
            ['category' => 'Makanan', 'description' => 'Pizza Hut', 'amount' => 175000, 'days' => 9],
            ['category' => 'Transport', 'description' => 'BBM Mobil', 'amount' => 300000, 'days' => 10],
        ];

        foreach ($expenses as $exp) {
            Transaction::firstOrCreate(
                ['description' => $exp['description'], 'user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'category_id' => $categoryIds[$exp['category']],
                    'type' => 'expense',
                    'amount' => $exp['amount'],
                    'description' => $exp['description'],
                    'date' => $now->copy()->subDays($exp['days']),
                ]
            );
        }

        // Create budgets
        $budgets = [
            ['category' => 'Makanan', 'amount' => 2000000],
            ['category' => 'Transport', 'amount' => 1000000],
            ['category' => 'Belanja', 'amount' => 1500000],
            ['category' => 'Hiburan', 'amount' => 500000],
        ];

        foreach ($budgets as $b) {
            Budget::firstOrCreate(
                ['user_id' => $user->id, 'category_id' => $categoryIds[$b['category']], 'period' => 'monthly'],
                [
                    'user_id' => $user->id,
                    'category_id' => $categoryIds[$b['category']],
                    'amount' => $b['amount'],
                    'period' => 'monthly',
                    'start_date' => $now->copy()->startOfMonth(),
                    'alert_threshold' => 80,
                ]
            );
        }

        $this->command->info('Demo user created: demo@duitku.com / password');
    }
}
