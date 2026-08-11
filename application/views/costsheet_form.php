<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?> | Ganga Fernhill Phase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background:#f4f5f7; }
        .brand-bar { background:#eeeeee; padding:18px 25px; }
        .brand-title { color:#d31e28; font-weight:800; letter-spacing:1px; }
        .badge-project {
            border:2px solid #d31e28; border-radius:30px; padding:8px 25px;
            font-weight:700; font-size:1.15rem; display:inline-block; background:#fff;
        }
        .card-form { max-width: 820px; margin: 30px auto; border:none; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .section-title {
            background:#333333; color:#fff; padding:10px 18px; font-weight:700;
            letter-spacing:.5px; border-radius:4px 4px 0 0;
        }
        .form-label { font-weight:600; color:#333; }
        .btn-save { background:#d31e28; border-color:#d31e28; font-weight:700; padding:10px 30px; }
        .btn-save:hover { background:#b0161f; border-color:#b0161f; }
        .required:after { content:" *"; color:#d31e28; }
    </style>
</head>
<body>

<div class="brand-bar text-center">
    <div class="brand-title h5 mb-2">GOEL GANGA DEVELOPMENTS</div>
    <span class="badge-project">GANGA FERNHILL PHASE</span>
    <div class="h6 mt-2 font-weight-bold">UNDRI</div>
</div>

<div class="card card-form">
    <div class="section-title">COSTSHEET DETAILS &amp; CALCULATIONS - ENTRY FORM</div>
    <div class="card-body">

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

        <?php echo form_open('costsheet/save'); ?>

            <h6 class="text-uppercase text-muted mb-3">Customer Details</h6>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label required">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control"
                           value="<?php echo set_value('customer_name'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control"
                           value="<?php echo set_value('mobile_number'); ?>" maxlength="15" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Flat No.</label>
                    <input type="text" name="flat_no" class="form-control"
                           value="<?php echo set_value('flat_no'); ?>" required>
                </div>
            </div>

            <hr>
            <h6 class="text-uppercase text-muted mb-3">Costsheet Details</h6>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label required">Type</label>
                    <select name="flat_type" class="form-control" required>
                        <option value="1 BHK" selected>1 BHK</option>
                        <option value="2 BHK">2 BHK</option>
                        <option value="2.5 BHK">2.5 BHK</option>
                        <option value="3 BHK">3 BHK</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Area (sqft)</label>
                    <input type="number" step="0.01" name="area" id="area" class="form-control"
                           value="<?php echo set_value('area', '635'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Rate (per sqft)</label>
                    <input type="number" step="0.01" name="rate" id="rate" class="form-control"
                           value="<?php echo set_value('rate', '4230'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Carpet Area (sqft)</label>
                    <input type="number" step="0.01" name="carpet_area" class="form-control"
                           value="<?php echo set_value('carpet_area', '465.30'); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label required">MSEB</label>
                    <input type="number" step="0.01" name="mseb" class="form-control"
                           value="<?php echo set_value('mseb', '60000'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Society Formation</label>
                    <input type="number" step="0.01" name="society_formation" class="form-control"
                           value="<?php echo set_value('society_formation', '30000'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Club House Charges</label>
                    <input type="number" step="0.01" name="club_house_charges" class="form-control"
                           value="<?php echo set_value('club_house_charges', '65000'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Stamp Duty</label>
                    <input type="number" step="0.01" name="stamp_duty" class="form-control"
                           value="<?php echo set_value('stamp_duty', '162000'); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label required">Maintenance</label>
                    <input type="number" step="0.01" name="maintenance" class="form-control"
                           value="<?php echo set_value('maintenance', '50000'); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label required">Registration</label>
                    <input type="number" step="0.01" name="registration" class="form-control"
                           value="<?php echo set_value('registration', '30000'); ?>" required>
                </div>
            </div>

            <div class="alert alert-light border small">
                <strong>Note:</strong> Agr. Cost, Total Amount Paid to Developer, GST and Total Cost are
                calculated automatically on save &mdash; Agr. Cost = Area &times; Rate,
                GST = 12% of Agr. Cost + 18% of Maintenance (as per the costsheet notes).
            </div>

            <div class="text-right mt-4">
                <a href="<?php echo site_url('costsheet/list_all'); ?>" class="btn btn-outline-secondary mr-2">View Saved Costsheets</a>
                <button type="submit" class="btn btn-save text-white">Save &amp; Generate Costsheet</button>
            </div>

        <?php echo form_close(); ?>
    </div>
</div>

<div class="text-center text-muted small pb-4">
    &copy; <?php echo date('Y'); ?> Goel Ganga Developments &mdash; www.goelganga.in
</div>

</body>
</html>
