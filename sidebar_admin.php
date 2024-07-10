
          <li class="nav-item">
            <a href="../admin_dashboard" class="nav-link <?php if($hal == 'dasbor') { echo 'active';}?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../admin_administrator" class="nav-link <?php if($hal == 'administrator') { echo 'active';}?>">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Administator
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="../admin_siswa" class="nav-link <?php if($hal == 'siswa') { echo 'active';}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../admin_guru" class="nav-link <?php if($hal == 'guru') { echo 'active';}?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Guru
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="../admin_kelas" class="nav-link <?php if($hal == 'kelas') { echo 'active';}?>">
              <i class="nav-icon fas fa-archway"></i>
              <p>
                Kelas
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="../admin_mapel" class="nav-link <?php if($hal == 'mapel') { echo 'active';}?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mapel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../admin_jurusan" class="nav-link <?php if($hal == 'jurusan') { echo 'active';}?>">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Jurusan
              </p>
            </a>
          </li>

        <li class="nav-item">
          <a href="../ganti_pw" class="nav-link <?php if ($hal == 'gantipassword') { echo 'active'; } ?>">
            <i class="nav-icon fas fa-lock "></i>
            <p>
            Ganti Password
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../auth/logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt "></i>
            <p>
            Keluar
            </p>
          </a>
        </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>