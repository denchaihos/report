<div class="container">
    <div class="col-md-10">
        <div class="form-area">
            <form role="form" method="get" action="createReport.php">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Create Report Form</h3>
                <div class="form-group">
                    <label for="contain">Report Name</label>
                    <input type="text" class="form-control" id="report_name" name="report_name" placeholder="report_name" required>
                </div>
                <div class="form-group">
                    <label for="contain">Department Or Group Report</label>
                    <select class="form-control" id="department" name="department">
                        <option value="0">select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contain">Request By</label>
                    <input type="text" class="form-control" id="requester" name="requester" placeholder="Request By" >
                </div>
                <div class="form-group">
                    <label for="contain">Note</label>
                    <textarea class="form-control" type="textarea" id="note" name="note" placeholder="Message" maxlength="140" rows="7"></textarea>
                </div>
                <div class="form-group">
                    <label for="contain">SQL Query</label>
                    <textarea class="form-control" type="textarea" id="sql_query" name="sql_query" placeholder="SQL--" maxlength="700" rows="15"></textarea>
                    <!-- <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>-->
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Save</button>
            </form>
        </div>
    </div>
</div>
<script src="function/createReport.js"></script>