<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStaffProfile extends CI_Model
{
	var $table = 'hrm_staffprofile as sp';
	var $column_order = array(null, 'sp.StaffNo', 'sp.FirstName', 'sp.LastName', 'sp.Email', 'sp.Address', 'prov.id', 'prov.name', 'reg.id', 'reg.name', 'dis.id', 'dis.name', 'vil.id', 'vil.name', 'ins.nama_instansi', 'ins.instansi_id', 'br.branch_id', 'br.nama_branch', 'sh.id', 'sh.shift', 'ds.id', 'ds.designation', 'ps.id', 'ps.position', 'dp.id', 'dp.departement');
	var $column_search = array('sp.StaffNo', 'sp.FirstName', 'sp.LastName', 'sp.Email', 'sp.Address', 'prov.id', 'prov.name', 'reg.id', 'reg.name', 'dis.id', 'dis.name', 'vil.id', 'vil.name', 'ins.nama_instansi', 'ins.instansi_id', 'br.branch_id', 'br.nama_branch', 'sh.id', 'sh.shift', 'ds.id', 'ds.designation', 'ps.id', 'ps.position', 'dp.id', 'dp.departement');
	var $order = array('sp.StaffNo' => 'asc');

	public function __construct()
	{
		parent::__construct();
	}

	// get all
	function get_all()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('deleted_at', NULL);
		return $this->db->get('hrm_staffprofile')->result_array();
	}


	public function tipeFile()
	{
		return ['Ijazah', 'Transkrip', 'Sertifikat', 'KTP', 'NPWP'];
	}
	public function pendidikan()
	{
		return ['Sekolah Dasar', 'Sekolah Menengah Pertama', 'Sekolah Menengah Atas', 'Diploma', 'Strata 1', 'Strata 2', 'Strata 3'];
	}
	public function getEmployee($id)
	{
		return $this->db->select('hrm_staffprofile.*, hrm_positions.position, hrm_positions.incentive, hrm_departments.department, hrm_contracts.duration, hrm_contracts.days, hrm_contracts.description, hrm_shifts.shift, hrm_shifts.day, hrm_shifts.start_time, hrm_shifts.end_time')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->join('hrm_contracts', 'hrm_contracts.id = hrm_staffprofile.contract_id')
			->join('hrm_shifts', 'hrm_shifts.id = hrm_staffprofile.shift_id')
			->where('hrm_staffprofile.id', $id)
			->where('hrm_staffprofile.deleted_at', null)
			->get('hrm_staffprofile')
			->row_array();
	}
	public function getGapokSlip($id, $idPeriode)
	{
		return $this->db->select('absen.staff_id, periode.year, periode.month, SUM(absen.daily_paid) AS gapok')
			->group_by('absen.period_id')
			->join('hrm_payroll_periods AS periode', 'periode.id = absen.period_id')
			->where('absen.staff_id', $id)
			->where('periode.id', $idPeriode)
			->get('hrm_attendance AS absen')
			->row_array();
	}
	public function getTunjanganSlip($id)
	{
		return $this->db->select('staff.first_name, staff.last_name, posisi.position, depart.department, posisi.incentive AS insentif, SUM(tunjangan.amount) AS tunjangan')
			->join('hrm_positions AS posisi', 'posisi.id = staff.position_id')
			->join('hrm_staff_allowances AS tunjangan', 'tunjangan.staff_id = staff.id')
			->join('hrm_departments AS depart', 'depart.id = staff.departement_id')
			->where('staff.id', $id)
			->get('hrm_staffprofile AS staff')
			->row_array();
	}
	public function getGapok($id)
	{
		return $this->db->select('absen.staff_id, periode.year, periode.month, SUM(absen.daily_paid) AS gapok')
			->group_by('absen.period_id')
			->join('hrm_payroll_periods AS periode', 'periode.id = absen.period_id')
			->where('absen.staff_id', $id)
			->get('hrm_attendance AS absen')
			->result_array();
	}
	public function getTunjangan($id)
	{
		return $this->db->select('posisi.incentive AS insentif, SUM(tunjangan.amount) AS tunjangan')
			->join('hrm_positions AS posisi', 'posisi.id = staff.position_id')
			->join('hrm_staff_allowances AS tunjangan', 'tunjangan.staff_id = staff.id')
			->where('staff.id', $id)
			->get('hrm_staffprofile AS staff')
			->row_array();
	}

	private function _get_datatables_query()
	{
		$this->db->select('sp.StaffNo', 'sp.FirstName', 'sp.LastName', 'sp.Email', 'sp.Address', 'sp.Phone');
		$this->db->from($this->table);
		$this->db->join('provinces as prov', 'prov.id = sp.prov_id', 'left');
		$this->db->join('regencies as reg', 'reg.id = sp.kab_id', 'left');
		$this->db->join('districts as dis', 'dis.id = sp.kec_id', 'left');
		$this->db->join('villages as vil', 'vil.id = sp.desa_id', 'left');
		$this->db->join('instansi as ins', 'ins.instansi_id = sp.instansi_id', 'left');
		$this->db->join('branch as br', 'br.branch_id = sp.branch_id', 'left');
		$this->db->join('hrm_manageshift as sh', 'sh.id = sp.ShiftID', 'left');
		$this->db->join('hrm_managedesignation as ds', 'ds.id = sp.DesignationID', 'left');
		$this->db->join('hrm_positions as ps', 'ps.id = sp.PositionID', 'left');
		$this->db->join('hrm_departments as dp', 'dp.id = sp.DepartementID', 'left');
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {

				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getStaffProfile($where = '')
	{
		$this->db->select("profile.*, IF(gender='L', 'Laki-Laki', 'Perempuan') AS gender, position.position, position.id as position_id");
		$this->db->from('hrm_staffprofile profile');
		$this->db->join('hrm_positions position', 'position.id = profile.position_id', 'left');
		return $this->db->get()->result_array();
	}


	function selectStaffProfile($id)
	{
		$this->db->select('
			staff.first_name,
			staff.id_personel,
			position.position,
			department.department,
		');
		$this->db->from('hrm_staffprofile staff');
		$this->db->join('hrm_positions position', 'position.id = staff.position_id', 'left');
		$this->db->join('hrm_departments department', 'department.id = staff.departement_id', 'left');
		$this->db->where('staff.id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffByIdPersonel($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_personel', $id);
		return $this->db->get()->row_array();
	}

	public function getProvincesSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM provinces
          $where ")->result_array();
	}
	public function getRegenciesSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM regencies
          $where ")->result_array();
	}

	public function getDistrictsSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM districts
          $where ")->result_array();
	}
	public function getVillagesSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM villages
          $where ")->result_array();
	}
	public function getInstansiSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM instansi
          $where ")->result_array();
	}
	public function getBranchSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM branch
          $where ")->result_array();
	}

	public function getShiftSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_shifts
          $where ")->result_array();
	}
	public function getDesignationSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_managedesignation
          $where ")->result_array();
	}

	public function getPositionSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_positions
          $where ")->result_array();
	}
	public function getDepartementSelect2($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_departments
          $where ")->result_array();
	}


	function getDetailStaffProfileById($id)
	{
		$this->db->select("profile.*, IF(gender='L', 'Laki-Laki', 'Perempuan') AS gender");
		$this->db->from('hrm_staffprofile profile');
		$this->db->where('profile.id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffContacts($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_emergencycontacts');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}

	function getContactById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_emergencycontacts');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffDocuments($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_documents');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}
	function getDocumentById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_documents');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffQualifications($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_qualifications');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}
	function getQualificationById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_qualifications');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}


	function getStaffExperiences($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staffworkexperiences');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}
	function getExperienceById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staffworkexperiences');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getStaffBankAccounts($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staffbankaccount');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}
	function getBankAccountById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staffbankaccount');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getFamilyMembers($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_families');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
	}
	function getFamilyMembersById($id)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_families');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
}
