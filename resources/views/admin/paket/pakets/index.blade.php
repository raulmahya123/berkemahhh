<x-app-layout>
    <style>
        h1 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-create {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-create:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #2196F3;
        }
        .btn-edit:hover {
            background-color: #0b7dda;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }
    </style>

    <h1>Daftar Paket</h1>
    <a href="{{ route('admin.paket.pakets.create') }}" class="btn-create">Buat Paket Baru</a>

    <ul>
        @foreach($pakets as $paket)
            <li>
                <span><a href="{{ route('admin.paket.pakets.show', $paket) }}">{{ $paket->name }} - {{ $paket->getFormattedPrice() }}</a></span>
                <span>
                    <a href="{{ route('admin.paket.pakets.edit', $paket) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('admin.paket.pakets.destroy', $paket) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-app-layout>
