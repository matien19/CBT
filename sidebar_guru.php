          <li class="nav-item">
            <a href="../guru_dashboard" class="nav-link <?php if($hal == 'dasbor') { echo 'active';}?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../guru_ujian" class="nav-link <?php if($hal == 'ujian') { echo 'active';}?>">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Ujian
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