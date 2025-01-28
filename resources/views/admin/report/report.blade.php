<x-admin-layout title="Report">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="report" activePage="report">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Report" subtitle="View Reports">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Report</h4>
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