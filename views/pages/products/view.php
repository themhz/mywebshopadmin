<div class="main-content-inner">
    <div class="row">
        <!-- Progress Table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Progress Table</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Εικόνα</th>
                                    <th scope="col">Όνομα Προϊόντος</th>
                                    <th scope="col">Τιμή</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($params[0] as $rows) { ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><img src="/userfiles/products/<?php echo $rows->image ?>" alt="Product Image" style="width: 100px;"></td>
                                    <td><?php echo $rows->name ?></td>
                                    <td>&euro; <?php echo $rows->price ?></td>
                                    <td>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td><span class="status-p bg-primary">pending</span></td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Progress Table end -->
    </div>
</div>