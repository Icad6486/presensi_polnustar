<!-- App Bottom Menu -->
<div class="appBottomMenu">
        <a href="/dashboard" class="item {{request()->is('dashboard')?'active' : ''}}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/presensi/histori" class="item {{request()->is('presensi/histori')?'active' : ''}}">
            <div class="col">
                <ion-icon name="file-tray-full-outline" role="img" class="md hydrated"
                    aria-label="file-tray-full-outline"></ion-icon>
                <strong>Histori</strong>
            </div>
        </a>       
        <a href="/presensi/create" class="item">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="finger-print-outline"></ion-icon>
                </div>
            </div>
        </a>
        <a href="/presensi/izin" class="item {{request()->is('presensi/izin')?'active' : ''}}">
            <div class="col">
                <ion-icon name="document-attach-outline" role="img" class="md hydrated"
                    aria-label="document-attach-outline"></ion-icon>
                <strong>Izin</strong>
            </div>
        </a>
        <a href="/editprofile" class="item {{request()->is('editprofile')?'active' : ''}}">
            <div class="col">
                <ion-icon name="person-circle-outline" role="img" class="md hydrated" aria-label="person-circle-outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
  