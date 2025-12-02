<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 200px;
            border-radius: 10px;
        }

        .card {
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-md-4 {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }

        @media (max-width: 768px) {
            .col-md-4 {
                flex: 1 1 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .col-md-4 {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
        
        /* Additional responsive improvements */
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .card-body {
            padding: 15px;
        }
        
        @media (max-width: 768px) {
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
            .btn {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }
    </style>

    <div class="row">
        @foreach($jbis as $jbi)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('uploads/foto_jbi/' . $jbi->foto) }}" class="card-img-top" alt="Foto {{ $jbi->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $jbi->nama }}</h5>
                        <p class="card-text">{{ $jbi->keahlian }}</p>
                        <a href="{{ route('user.jbi.order', $jbi->id) }}" class="btn btn-primary">Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
