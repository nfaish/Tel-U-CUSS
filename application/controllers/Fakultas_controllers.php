<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas_controllers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("fakultas_model");
        $this->load->model("ruangan_model");
        $this->load->library('excel');
    }

    public function index()
    {
        redirect("Data_controllers/fakultas");
    }

    public function exploreJurusan($id_jurusan)
    {
        $data['jurusanByID'] = $this->fakultas_model->jurusanByID($id_jurusan);
        // $data['angkatanByID'] = $this->fakultas_model->angkatanByID($id_jurusan);
        $data['kelasJurusan'] = $this->fakultas_model->daftar_kelas($id_jurusan);

        $this->load->view("jurusan_view/detail_jurusan", $data);
    }

    public function exploreFakultas($id_fakultas)
    {
        $this->load->model('Fakultas_model');
        $data['list_gedung'] = $this->fakultas_model->daftar_gedung();
        $data['gedung_select'] = $this->fakultas_model->daftar_gedungByID($id_fakultas);
        $data['list_jurusanfakultas'] = $this->fakultas_model->daftar_jurusanfakultas($id_fakultas);
        $data['dataFakultas'] = $this->fakultas_model->load_FakultasSelect($id_fakultas);
        $data['list_gedungfakultas'] = $this->fakultas_model->daftar_gedungfakultas($id_fakultas);
        $data['list_fakultas_gedung'] = $this->fakultas_model->daftar_fakultas_gedung($id_fakultas);
        // $data['fakultas_gedung_select'] = $this->fakultas_model->daftar_fakultas_gedungByID($id_fakultas);
        // $data['dataLokasiGedung'] = $this->fakultas_model->load_Lokasi_GedungSelect($id_gedung_fakultas);
        if (isset($_POST['updateFakultas'])) {
            $this->fakultas_model->updateFakultas($id_fakultas);
            redirect("data_controllers/fakultas");
        }
        $this->load->view('jurusan_view/detail_fakultas', $data);
    }

    // public function exploreFakultas($id_fakultas)
    // {
    //     $data['fakultasByID'] = $this->fakultas_model->fakultasByID($id_fakultas);
    //     $data['jurusanByID'] = $this->fakultas_model->daftar_jurusan();
    //     $this->load->model('fakultas_model');
    //     if (isset($_POST['updateFakultas'])) 
    //     {
    //         $this->fakultas_model->updateFakultas($id_fakultas);
    // 		redirect("fakultas_controllers/detail_fakultas");
    // 	}

    //     $this->load->view("jurusan_view/detail_fakultas", $data);
    // }

    public function fetch()
    {
        $data = $this->fakultas_model->select();
        $output = '
        <h3 align="center">Total Data - ' . $data->num_rows() . '</h3>
        <table class="table table-striped table-bordered">
        <tr>
            <th>Nama Kelas</th>
            <th>Angkatan</th>
            <th>Dosen Wali</th>
        </tr>
        ';
        foreach ($data->result() as $row) {
            $output .= '
        <tr>
            <td>' . $row->nama_kelas . '</td>
            <td>' . $row->angkatan . '</td>
            <td>' . $row->dosen_wali . '</td>
        </tr>
        ';
        }
        $output .= '</table>';
        echo $output;
    }

    public function import()
    {
        $id_jurusan = $this->session->id_jurusan;


        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nama_kelas = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $angkatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $dosen_wali = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $data[] = array(
                        'id_jurusan'    => $id_jurusan,
                        'nama_kelas'    => $nama_kelas,
                        'angkatan'      => $angkatan,
                        'dosen_Wali'    => $dosen_wali
                    );
                }
            }
            $this->fakultas_model->insert($data);
            echo 'Data Imported successfully';
        }
    }

    public function hapusJurusan($id_jurusan)
    {
        $data['list_jurusan'] = $this->fakultas_model->hapus_jurusan($id_jurusan);
        $this->load->view("data/fakultas_view", $data);
        // redirect('Data_controllers/fakultas');
    }

    public function hapusFakultas($id_fakultas)
    {
        $data['list_fakultas'] = $this->fakultas_model->hapusFakultas($id_fakultas);
        $this->load->view("data/fakultas_view", $data);
    }
}