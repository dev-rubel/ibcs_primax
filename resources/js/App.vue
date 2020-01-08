<template>
	<div id="wrapper">

    <!-- Sidebar -->
    <Sidebar />
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <Nav />
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <router-view></router-view>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <Footer />
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
</template>
<script>
import Sidebar from './components/Sidebar'
import Nav from './components/Nav'
import Footer from './components/Footer'
export default {
	components: {
		Sidebar,
		Nav,
		Footer
	}
}
</script>