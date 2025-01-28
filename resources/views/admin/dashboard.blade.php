<x-admin-layout title="Dashboard">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="dashboard" activePage="dashboard"></x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Dashboard" subtitle="View Dashboard">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Default Layout</h4>
            </div>
            <div class="card-body">

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, commodi? Ullam quaerat
                similique iusto
                temporibus, vero aliquam praesentium, odit deserunt eaque nihil saepe hic deleniti?
                Placeat
                delectus
                quibusdam ratione ullam!
            </div>
        </div>
    </x-slot>

</x-admin-layout>