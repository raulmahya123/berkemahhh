<x-app-layout>
    <div class="coupons-container">
        <h1>Coupons</h1>
        <a href="{{ route('admin.coupon.create') }}" class="btn">Create Coupon</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Coupon Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($coupons->isEmpty())
                    <tr>
                        <td colspan="3">No coupons found.</td>
                    </tr>
                @else
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>
                                <a class="view-button" href="{{ route('admin.coupon.show', $coupon->id) }}">View</a>
                                <a class="edit-button" href="{{ route('admin.coupon.edit', $coupon->id) }}">Edit</a>
                                <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .coupons-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.2s;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
            color: #007BFF;
            transition: color 0.2s;
        }

        a:hover {
            color: #0056b3;
        }

        .view-button,
        .edit-button {
            background-color: #007BFF;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .view-button:hover {
            background-color: #0056b3;
        }

        .edit-button {
            background-color: #4CAF50;
        }

        .edit-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-left: 5px;
        }

        .delete-button:hover {
            background-color: #e53935;
        }
    </style>
</x-app-layout>
