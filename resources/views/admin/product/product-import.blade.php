<x-admin.admin-layout title="Product">
    <x-slot name="sidebar">
        <x-admin.admin-sidebar activeModule="product" activePage="product"></x-admin.admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin.admin-page-title title="Product" subtitle="Product Import">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/product">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Import</li>
        </x-admin.admin-page-title>
    </x-slot>

    <x-slot name="main">

        <div class="card">

            <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem cumque eos iusto, magni voluptatibus sint
                excepturi ad quia incidunt blanditiis, odio dolore? Quos qui sunt, nemo magnam delectus facilis sed.
            </div>

        </div>
    </x-slot>

    <x-slot name="script">
        {{-- --}}
    </x-slot>

</x-admin.admin-layout>