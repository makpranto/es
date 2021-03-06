<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Stock Details</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"> Discount</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Category:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="category">
                                            <option value='ALL'>ALL</option>
                                            <?php
                                                $run = r("SELECT `name` FROM `categories` WHERE `company_id` = '$company_id'");
                                                while ($a = get($run)) {
                                                    echo "<option value='". $a['name']."'>". $a['name']."</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Update in Real Time:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="$160.00"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Title:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="..."></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Description:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Sheets containing Lorem"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Lorem, Ipsum, has, been"></div>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">ID:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="543"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Model:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="..."></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Location:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="location"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tax Class:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" >
                                            <option>option 1</option>
                                            <option>option 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Quantity:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Quantity"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Minimum quantity:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="2"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Sort order:</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" placeholder="0"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" >
                                            <option>option 1</option>
                                            <option>option 2</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>


                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">

                                    <thead>
                                    <tr>
                                        <th>
                                            Group
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Discount
                                        </th>
                                        <th style="width: 20%">
                                            Date start
                                        </th>
                                        <th style="width: 20%">
                                            Date end
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control" >
                                                <option selected>Group 1</option>
                                                <option>Group 2</option>
                                                <option>Group 3</option>
                                                <option>Group 4</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="10">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="$10.00">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                    <tr>
                                        <th>
                                            Image preview
                                        </th>
                                        <th>
                                            Image url
                                        </th>
                                        <th>
                                            Sort order
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/2s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/1s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image2.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="2">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/3s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image3.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="3">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/4s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image4.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="4">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/5s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image5.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="5">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/6s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image6.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="6">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/gallery/7s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" disabled value="http://mydomain.com/images/image7.png">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="7">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
