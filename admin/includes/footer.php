        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <?= AppName() ?> 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Market Modal -->
        <div class="modal fade" id="createMarket" tabindex="-1" role="dialog" aria-labelledby="Create Market" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" class="user">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create a market</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="market" placeholder="Market Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="lga" placeholder="LGA">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="createMarket" class="btn btn-primary">Submit</a>
                        </div>
                        <?php createMarket(); ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Create Vendor Modal -->
        <div class="modal fade" id="createVendor" tabindex="-1" role="dialog" aria-labelledby="Create Vendor" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" class="user">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create vendor</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <select name="market" class="browser-select custom-select">
                                    <option value="" default>Select Market</option>
                                    <?php 
                                        $markets = getAll('markets');
                                        foreach ($markets as $market): 
                                    ?>
                                        <option value="<?= $market['id']; ?>"><?= $market['market']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="createVendor" class="btn btn-primary">Submit</a>
                        </div>
                        <?php createVendors(); ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- Create Item Modal -->
        <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="Add item" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" class="user" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="name" placeholder="Item Name">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" name="price" placeholder="Item Price">
                            </div>
                            <div class="form-group">
                                <select name="vendor" class="browser-select custom-select">
                                    <option value="" default>Select Vendor</option>
                                    <?php 
                                        $vendors = getAll('vendors');
                                        foreach ($vendors as $vendor): 
                                    ?>
                                        <option value="<?= $vendor['id']; ?>"><?= $vendor['name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input type="file" name="picture" id="picture" class="d-none"/>
                                <label for="picture" class="btn btn-lg btn-primary">Upload item picture</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="addItems" class="btn btn-primary">Submit</a>
                        </div>
                        <?php addItems(); ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="/admin/vendor/jquery/jquery.min.js"></script>
        <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="/admin/js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="/admin/vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="/admin/js/demo/chart-area-demo.js"></script>
        <script src="/admin/js/demo/chart-pie-demo.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
    </body>
</html>