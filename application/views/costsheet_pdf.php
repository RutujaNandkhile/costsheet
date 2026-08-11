<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Helper to format numbers like the reference sheet (e.g. 26,86,050)
function fmt($n) {
    return number_format((float) $n, ((float)$n == (int)$n) ? 0 : 2);
}
?>
<style>
    body { font-family: helvetica; }
    .header-box { background-color:#eeeeee; padding:8px; }
    .brand { color:#d31e28; font-weight:bold; font-size:11pt; }
    .brand-sub { color:#333333; font-size:6pt; }
    .badge {
        border:1.5px solid #d31e28; border-radius:20px; padding:6px 14px;
        font-weight:bold; font-size:13pt; color:#111111;
    }
    .location { font-weight:bold; font-size:11pt; color:#111111; }
    .cust-table td { font-size:10pt; padding:3px 4px; }
    .section-title {
        background-color:#333333; color:#ffffff; font-weight:bold; font-size:12pt;
        padding:8px; text-align:center;
    }
    .th-type { background-color:#d92230; color:#ffffff; font-weight:bold; font-size:11pt; padding:8px; text-align:center; }
    .row-label { background-color:#f6c9cb; font-weight:bold; font-size:10pt; padding:7px; }
    .row-value { background-color:#ffffff; font-size:10pt; padding:7px; text-align:center; border:0.5px solid #999999; }
    .row-total-label { background-color:#ef9ea3; font-weight:bold; font-size:10pt; padding:7px; }
    .row-total-value { background-color:#dddddd; font-weight:bold; font-size:10pt; padding:7px; text-align:center; border:0.5px solid #999999; }
    .grand-label { background-color:#f08a90; font-weight:bold; font-size:11pt; padding:8px; }
    .grand-value { background-color:#dddddd; font-weight:bold; font-size:11pt; padding:8px; text-align:center; border:0.5px solid #999999; }
    .note-title { font-weight:bold; font-size:10pt; }
    .note-text { font-size:8pt; color:#222222; }
</style>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td class="header-box" width="100%">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td width="30%"><span class="brand">GOEL GANGA</span><br/><span class="brand">DEVELOPMENTS</span><br/><span class="brand-sub">www.goelganga.in</span></td>
    <td width="45%" align="center"><span class="badge"><?php echo html_escape($row->project_name); ?></span></td>
    <td width="25%"></td>
</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td align="center"><span class="location"><?php echo html_escape($row->project_location); ?></span></td></tr>
</table>
</td>
</tr>
</table>

<br/>

<table width="100%" cellpadding="0" cellspacing="0" class="cust-table">
<tr><td width="30%"><strong>Customer Name:</strong></td><td><?php echo html_escape($row->customer_name); ?></td></tr>
<tr><td><strong>Mobile Number:</strong></td><td><?php echo html_escape($row->mobile_number); ?></td></tr>
<tr><td><strong>Flat:</strong></td><td><?php echo html_escape($row->flat_no); ?></td></tr>
</table>

<br/>

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td class="section-title">COSTSHEET DETAILS &amp; CALCULATIONS</td></tr>
</table>

<br/>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
    <td class="th-type" width="70%">Type</td>
    <td class="th-type" width="30%"><?php echo html_escape($row->flat_type); ?></td>
</tr>
<tr>
    <td class="row-label">Area</td>
    <td class="row-value"><?php echo fmt($row->area); ?></td>
</tr>
<tr>
    <td class="row-label">Rate</td>
    <td class="row-value"><?php echo fmt($row->rate); ?></td>
</tr>
<tr>
    <td class="row-label">Carpet Area</td>
    <td class="row-value"><?php echo fmt($row->carpet_area); ?></td>
</tr>
<tr>
    <td class="row-label">Agr. Cost</td>
    <td class="row-value"><?php echo fmt($row->agr_cost); ?></td>
</tr>
<tr>
    <td class="row-label">MSEB</td>
    <td class="row-value"><?php echo fmt($row->mseb); ?></td>
</tr>
<tr>
    <td class="row-label">Society Formation</td>
    <td class="row-value"><?php echo fmt($row->society_formation); ?></td>
</tr>
<tr>
    <td class="row-label">Club House Charges</td>
    <td class="row-value"><?php echo fmt($row->club_house_charges); ?></td>
</tr>
<tr>
    <td class="row-total-label">Total Amount Paid to Developer</td>
    <td class="row-total-value"><?php echo fmt($row->total_paid_to_developer); ?></td>
</tr>
<tr>
    <td class="row-label">Stamp-Duty</td>
    <td class="row-value"><?php echo fmt($row->stamp_duty); ?></td>
</tr>
<tr>
    <td class="row-label">Maintenance</td>
    <td class="row-value"><?php echo fmt($row->maintenance); ?></td>
</tr>
<tr>
    <td class="row-label">Registration</td>
    <td class="row-value"><?php echo fmt($row->registration); ?></td>
</tr>
<tr>
    <td class="row-label">GST</td>
    <td class="row-value"><?php echo fmt($row->gst); ?></td>
</tr>
<tr>
    <td class="grand-label">Total cost</td>
    <td class="grand-value"><?php echo fmt($row->total_cost); ?></td>
</tr>
</table>

<br/>
<hr/>

<table width="100%" cellpadding="2" cellspacing="0">
<tr>
    <td width="12%" class="note-title">Note :</td>
    <td class="note-text">
        1. Cheque Should Be drawn In favor of "Meenamani Ganga Builder LLP"<br/>
        2. 1% TDS will be applicable For agreement Value more than 50Lac<br/>
        3. GST 12% on Agreement Cost, GST 18% on Maintenance Cost<br/>
        4. Rates are subject to change without prior notice.<br/>
        5. Govt. Taxes May vary as per Govt. Policies and are to be paid as per actual.<br/>
        6. Rates are calculated after giving 200/- per sqft GST Discount<br/>
        7. Legal Charges Of Rs.10000/- to be paid at the time of Agreement Registration
    </td>
</tr>
</table>
