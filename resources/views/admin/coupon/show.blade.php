<x-app-layout>
    <div class="coupon-detail">
        <h1>Coupon Detail</h1>
        <p><strong>ID:</strong> {{ $coupon->id }}</p>
        <p><strong>Coupon Code:</strong> {{ $coupon->code }}</p>
        <div class="actions">
            <a class="edit-button" href="{{ route('admin.coupon.edit', $coupon->id) }}">Edit</a>
            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a class="back-button" href="{{ route('admin.coupons.index') }}">Back to Coupons</a>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .coupon-detail {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        .actions {
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            margin-right: 15px;
            color: #007BFF;
            transition: color 0.2s;
        }

        a:hover {
            color: #0056b3;
        }

        .edit-button,
        .delete-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .edit-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
            margin-left: 10px;
        }

        .delete-button:hover {
            background-color: #e53935;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</x-app-layout>
