<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background:#f4f5f7; }
        .wrap { max-width:1100px; margin:30px auto; }
        thead th { background:#333; color:#fff; }
        .btn-sm-action { padding:.2rem .5rem; font-size:.8rem; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Saved Costsheets</h5>
        <a href="<?php echo site_url('costsheet'); ?>" class="btn btn-danger btn-sm">+ New Costsheet</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Mobile</th>
                    <th>Flat</th>
                    <th>Type</th>
                    <th class="text-right">Total Cost</th>
                    <th>Saved On</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($costsheets)): ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">No costsheets saved yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($costsheets as $row): ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo html_escape($row->customer_name); ?></td>
                            <td><?php echo html_escape($row->mobile_number); ?></td>
                            <td><?php echo html_escape($row->flat_no); ?></td>
                            <td><?php echo html_escape($row->flat_type); ?></td>
                            <td class="text-right">&#8377; <?php echo number_format($row->total_cost, 0); ?></td>
                            <td><?php echo date('d-M-Y', strtotime($row->created_at)); ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('costsheet/pdf/' . $row->id); ?>" target="_blank"
                                   class="btn btn-outline-danger btn-sm-action">PDF</a>
                                <a href="<?php echo site_url('costsheet/delete/' . $row->id); ?>"
                                   onclick="return confirm('Delete this record?');"
                                   class="btn btn-outline-secondary btn-sm-action">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
