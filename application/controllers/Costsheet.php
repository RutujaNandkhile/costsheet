<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costsheet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Costsheet_model');
        $this->load->library('form_validation');
    }

    /**
     * Show the entry form
     */
    public function index()
    {
        $data['title'] = 'Costsheet Entry Form';
        $this->load->view('costsheet_form', $data);
    }

    /**
     * List all saved costsheets
     */
    public function list_all()
    {
        $data['title']      = 'Saved Costsheets';
        $data['costsheets'] = $this->Costsheet_model->get_all_costsheets();
        $this->load->view('costsheet_list', $data);
    }

    /**
     * Validate, calculate and save the form data to MySQL
     */
    public function save()
    {
        // ---- Validation rules ----
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required|trim|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('flat_no', 'Flat No', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('flat_type', 'Type', 'required|trim');
        $this->form_validation->set_rules('area', 'Area', 'required|numeric');
        $this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
        $this->form_validation->set_rules('carpet_area', 'Carpet Area', 'required|numeric');
        $this->form_validation->set_rules('mseb', 'MSEB', 'required|numeric');
        $this->form_validation->set_rules('society_formation', 'Society Formation', 'required|numeric');
        $this->form_validation->set_rules('club_house_charges', 'Club House Charges', 'required|numeric');
        $this->form_validation->set_rules('stamp_duty', 'Stamp Duty', 'required|numeric');
        $this->form_validation->set_rules('maintenance', 'Maintenance', 'required|numeric');
        $this->form_validation->set_rules('registration', 'Registration', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            // Re-show the form with validation errors
            $data['title'] = 'Costsheet Entry Form';
            $this->load->view('costsheet_form', $data);
            return;
        }

        // ---- Read posted values ----
        $area              = (float) $this->input->post('area', TRUE);
        $rate              = (float) $this->input->post('rate', TRUE);
        $carpet_area       = (float) $this->input->post('carpet_area', TRUE);
        $mseb              = (float) $this->input->post('mseb', TRUE);
        $society_formation = (float) $this->input->post('society_formation', TRUE);
        $club_house        = (float) $this->input->post('club_house_charges', TRUE);
        $stamp_duty        = (float) $this->input->post('stamp_duty', TRUE);
        $maintenance       = (float) $this->input->post('maintenance', TRUE);
        $registration      = (float) $this->input->post('registration', TRUE);

        // ---- Calculations (per the notes on the reference costsheet) ----
        // Agr. Cost = Area x Rate
        $agr_cost = round($area * $rate, 2);

        // Total Amount Paid to Developer = Agr Cost + MSEB + Society Formation + Club House Charges
        $total_paid_to_developer = round($agr_cost + $mseb + $society_formation + $club_house, 2);

        // GST: 12% on Agreement (Agr.) Cost, 18% on Maintenance Cost  (Note #3)
        $gst = round(($agr_cost * 0.12) + ($maintenance * 0.18), 2);

        // Total Cost = Total Paid to Developer + Stamp Duty + Maintenance + Registration + GST
        $total_cost = round($total_paid_to_developer + $stamp_duty + $maintenance + $registration + $gst, 2);

        $data = array(
            'project_name'            => 'GANGA FERNHILL PHASE',
            'project_location'        => 'UNDRI',
            'customer_name'           => $this->input->post('customer_name', TRUE),
            'mobile_number'           => $this->input->post('mobile_number', TRUE),
            'flat_no'                 => $this->input->post('flat_no', TRUE),
            'flat_type'               => $this->input->post('flat_type', TRUE),
            'area'                    => $area,
            'rate'                    => $rate,
            'carpet_area'             => $carpet_area,
            'agr_cost'                => $agr_cost,
            'mseb'                    => $mseb,
            'society_formation'       => $society_formation,
            'club_house_charges'      => $club_house,
            'total_paid_to_developer' => $total_paid_to_developer,
            'stamp_duty'              => $stamp_duty,
            'maintenance'             => $maintenance,
            'registration'            => $registration,
            'gst'                     => $gst,
            'total_cost'              => $total_cost,
        );

        try {
            $id = $this->Costsheet_model->insert_costsheet($data);
        } catch (\Throwable $e) {
            // Show the real DB/PHP error instead of a blank 500 page
            show_error(
                'Database insert failed.<br><br>' .
                '<strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '<br>' .
                '<strong>File:</strong> ' . htmlspecialchars($e->getFile()) . '<br>' .
                '<strong>Line:</strong> ' . $e->getLine() .
                '<br><br>Tip: open <a href="' . base_url('costsheet/diagnostics') . '">costsheet/diagnostics</a> ' .
                'to check your DB connection and table structure.',
                500,
                'Database Error'
            );
            return;
        }

        if ($id) {
            // Redirect to a success page with a link to view / download the PDF
            $sdata['title'] = 'Costsheet Saved';
            $sdata['id']    = $id;
            $sdata['row']   = $this->Costsheet_model->get_costsheet($id);
            $this->load->view('costsheet_success', $sdata);
        } else {
            show_error('Could not save the costsheet. The insert ran but returned no ID. Check application/logs/ for details.');
        }
    }

    /**
     * Diagnostics page: checks DB connection, table existence/structure,
     * and required PHP extensions. Visit costsheet/diagnostics in a browser.
     */
    public function diagnostics()
    {
        echo '<div style="font-family: monospace; padding: 25px; line-height:1.7;">';
        echo '<h2>Costsheet App Diagnostics</h2>';

        // --- PHP extensions ---
        echo '<h3>PHP Extensions</h3><ul>';
        foreach (array('mysqli', 'curl', 'gd', 'mbstring') as $ext) {
            $ok = extension_loaded($ext);
            echo '<li>' . $ext . ': ' . ($ok ? '<span style="color:green">OK</span>' : '<span style="color:red">MISSING</span>') . '</li>';
        }
        echo '</ul>';

        // --- DB connection ---
        echo '<h3>Database Connection</h3>';
        try {
            $db_ok = $this->db->conn_id ? true : false;
            echo $db_ok
                ? '<p style="color:green">Connected to database: ' . $this->db->database . '</p>'
                : '<p style="color:red">Could not connect to database.</p>';
        } catch (\Throwable $e) {
            echo '<p style="color:red">DB connection error: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }

        // --- Table check ---
        echo '<h3>Table: costsheets</h3>';
        if ($this->db->table_exists('costsheets')) {
            echo '<p style="color:green">Table exists.</p>';
            $fields = $this->db->field_data('costsheets');
            echo '<table border="1" cellpadding="6" cellspacing="0"><tr><th>Column</th><th>Type</th></tr>';
            foreach ($fields as $f) {
                echo '<tr><td>' . $f->name . '</td><td>' . $f->type . '(' . $f->max_length . ')</td></tr>';
            }
            echo '</table>';

            $required = array('project_name','project_location','customer_name','mobile_number','flat_no','flat_type',
                'area','rate','carpet_area','agr_cost','mseb','society_formation','club_house_charges',
                'total_paid_to_developer','stamp_duty','maintenance','registration','gst','total_cost');
            $existing = array_map(function($f){ return $f->name; }, $fields);
            $missing = array_diff($required, $existing);
            if (!empty($missing)) {
                echo '<p style="color:red"><strong>Missing columns:</strong> ' . implode(', ', $missing) . '</p>';
            } else {
                echo '<p style="color:green">All required columns are present.</p>';
            }
        } else {
            echo '<p style="color:red">Table "costsheets" does NOT exist. Re-import database/costsheet.sql.</p>';
        }

        echo '</div>';
    }

    /**
     * Generate and stream a PDF for the given costsheet id.
     * URL: costsheet/pdf/{id}
     * URL: costsheet/pdf/{id}/download  -> forces file download instead of inline view
     */
    public function pdf($id = null, $mode = 'view')
    {
        if ($id === null) {
            show_404();
        }

        $row = $this->Costsheet_model->get_costsheet($id);

        if (!$row) {
            show_error('Costsheet record not found.', 404);
        }

        // Load TCPDF library (bundled in application/third_party/tcpdf)
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Goel Ganga Developments');
        $pdf->SetAuthor('Goel Ganga Developments');
        $pdf->SetTitle('Costsheet - ' . $row->customer_name . ' - Flat ' . $row->flat_no);
        $pdf->SetSubject('Costsheet Details & Calculations');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(12, 12, 12);
        $pdf->SetAutoPageBreak(TRUE, 12);
        $pdf->AddPage();

        // Build the HTML that visually mirrors the reference costsheet layout
        $html = $this->load->view('costsheet_pdf', array('row' => $row), true);
        $pdf->writeHTML($html, true, false, true, false, '');

        $filename = 'Costsheet_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $row->customer_name) . '_Flat' . $row->flat_no . '.pdf';

        // 'D' = force download, 'I' = inline view in browser
        $output_mode = ($mode === 'download') ? 'D' : 'I';
        $pdf->Output($filename, $output_mode);
    }

    /**
     * Delete a saved costsheet
     */
    public function delete($id)
    {
        $this->Costsheet_model->delete_costsheet($id);
        redirect('costsheet/list_all');
    }
}
