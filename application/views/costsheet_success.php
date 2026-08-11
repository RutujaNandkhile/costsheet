<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background:#f4f5f7; }
        .card-box { max-width:600px; margin:60px auto; box-shadow:0 2px 12px rgba(0,0,0,.08); border:none; }
        .btn-pdf { background:#d31e28; border-color:#d31e28; }
        .btn-pdf:hover { background:#b0161f; border-color:#b0161f; }
    </style>
</head>
<body>
<div class="card card-box">
    <div class="card-body text-center p-5">
        <div class="mb-3" style="font-size:3rem; color:#28a745;">&#10004;</div>
        <h4 class="mb-3">Costsheet Saved Successfully</h4>
        <p class="text-muted">Record ID #<?php echo $id; ?> for
            <strong><?php echo html_escape($row->customer_name); ?></strong>
            (Flat <?php echo html_escape($row->flat_no); ?>) has been stored in the database.</p>

        <div class="d-flex justify-content-center flex-wrap mt-4">
            <a href="<?php echo site_url('costsheet/pdf/' . $id); ?>" target="_blank"
               class="btn btn-pdf text-white m-1">View PDF</a>
            <a href="<?php echo site_url('costsheet/pdf/' . $id . '/download'); ?>"
               class="btn btn-outline-danger m-1">Download PDF</a>
            <a href="<?php echo site_url('costsheet/list_all'); ?>" class="btn btn-outline-secondary m-1">View All</a>
            <a href="<?php echo site_url('costsheet'); ?>" class="btn btn-outline-dark m-1">New Entry</a>
        </div>
    </div>
</div>
</body>
</html>
