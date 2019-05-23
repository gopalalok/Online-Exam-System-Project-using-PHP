<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Exam
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getQuesByOrder()
		{
			$query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delQuestion($quesNo)
		{
			$tables = array("tbl_ques","tbl_ans");
			foreach ($tables as $table)
			{
				$delquery = "DELETE FROM $table WHERE quesNo = '$quesNo'";
				$deldata = $this->db->delete($delquery);
			}
			if($deldata)
			{
				$msg = "<span class ='success'>Data Deleted Successfully... !</span>";
				return $msg;
			}
			else
			{
				$msg = "<span class ='error'>Data not Deleted</span>";
				return $msg;
			}
		}

		public function AddQuestions($data)
		{
			$quesNo = $this->fm->validation($data['quesNo']);
			$ques = $this->fm->validation($data['ques']);
			$quesNo = mysqli_real_escape_string($this->db->link,$quesNo);
			$ques = mysqli_real_escape_string($this->db->link,$ques);
			$ans = array();
			$ans[1] = $data['ans1'];
			$ans[2] = $data['ans2'];
			$ans[3] = $data['ans3'];
			$ans[4] = $data['ans4'];
			$rightAns = $this->fm->validation($data['rightAns']);
			$rightAns = mysqli_real_escape_string($this->db->link,$rightAns);
			$query = "INSERT INTO tbl_ques(quesNo,ques) VALUES('$quesNo','$ques')";
			$insert_row = $this->db->insert($query);
			if($insert_row)
			{
				foreach ($ans as $key => $ansName)
			    {
					if($ansName != '')
					{
						if($rightAns == $key)
						{
							$rquery = "INSERT INTO tbl_ans(quesNo,rightAns,ans) VALUES('$quesNo','1','$ansName')";
						}
						else
						{
							$rquery = "INSERT INTO tbl_ans(quesNo,rightAns,ans) VALUES('$quesNo','1','$ansName')";
						}
						$insert_row = $this->db->insert($rquery);
						if($insert_row)
						{
							continue;
						}
						else
						{
							die('Error...');
						}
					}
				}
				$msg = "<span class='success'>Questions added Successfully.</span>";
			}
		}

		public function getTotalRows()
		{
			$query = "SELECT * FROM tbl_ques";
			$getResult = $this->db->select($query);
			$total = $getResult->num_rows;
			return $total;
		}

		public function getQuestions()
		{
			$query = "SELECT * FROM tbl_ques";
			$getResult = $this->db->select($query);
			$result = $getResult->fetch_assoc();
			return $result;
		}

		public function getQuesByNumber($number)
		{
			$query = "SELECT * FROM tbl_ques WHERE quesNo = '$number'";
			$getData = $this->db->select($query);
			$result = $getData->fetch_assoc();
			return $result;
		}

		public function getAnswer($number)
		{
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number'";
			$getData = $this->db->select($query);
			return $getData;
		}
		
	}


?>