<x-layout-app page-title="User profile">

        <h3>User profile</h3>
        <hr>

        <x-profile-user-data></x-profile-user-data>

        <hr>

        <div class="container-fluid m-0 p-0 mt-5">
            <div class="row g-4">

                <div class="col-md-3">
                    <x-profile-user-change-password />
                </div>

                <div class="col-md-3">
                    <x-profile-user-change-data />
                </div>

            </div>
        </div>

</x-layout-app>
