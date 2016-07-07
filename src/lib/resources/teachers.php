<?php
/*
 * @author	Nico Alt
 * @date	16.03.2016
 *
 * See the file "LICENSE" for the full license governing this code.
 */
require_once __DIR__ . '/abstractResource.php';
class Teachers extends AbstractResource {

	public function __construct($user) {
		parent::__construct($user);
		$this->resource = 'teachers';
	}

	/**
	 * Get one or more teachers.
	 */
	public function get($teacherID = null) {
		$sql = "SELECT * FROM " . Database::$tableTeachers;
		// Add where clause for ID
		if (isset($teacherID)) {
			$teacherID = $this->database->escape_string($teacherID);
			$sql .= " WHERE id LIKE '$teacherID'";
		}
		$query = $this->database->query($sql);
		if (!$query || $query->num_rows == 0) {
			return null;
		}
		$teachers = Array();
		while($column = $query->fetch_array()) {
			$teacher = Array(
							'id' => $column['id'],
							'name' => $column['name'],
							'archived' => ($column['archived'] == '0') ? 'false' : 'true',
							'added' => $column['added'],
							'edited' => $column['edited']
							);
			$teachers[] = $teacher;
		}
		return $teachers;
	}

	/**
	 * Create a teacher.
	 */
	public function create($name) {
		$name = $this->database->escape_string($name);
		$sql = "INSERT INTO " . Database::$tableTeachers . " (name) VALUES ('$name')";
		if ($this->database->query($sql)) {
			$id = $this->database->insert_id;
			if ($this->activities->log($this->user, Activities::ACTION_CREATE, self::THIS_RESOURCE, $id)) {
				return $id;
			}
			$this->delete($id);
		}
		return null;
	}

	/**
	 * Update a teacher.
	 */
	public function update($teacherID, $name, $archived) {
		$teacherID = $this->database->escape_string($teacherID);
		$name = $this->database->escape_string($name);
		$archived = $this->database->escape_string($archived);
		$sql = "UPDATE " . Database::$tableTeachers . " SET name = '$name', archived = '$archived' WHERE id = '$teacherID'";
		if ($this->database->query($sql)) {
			$this->activities->log($this->user, Activities::ACTION_UPDATE, self::THIS_RESOURCE, $teacherID);
			return true;
		}
		return false;
	}

	/**
	 * Delete a teacher.
	 */
	public function delete($teacherID) {
		$teacherID = $this->database->escape_string($teacherID);
		$sql = "DELETE FROM " . Database::$tableTeachers . " WHERE id = '$teacherID'";
		if ($this->database->query($sql)) {
			$this->activities->log($this->user, Activities::ACTION_DELETE, self::THIS_RESOURCE, $teacherID);
			return true;
		}
		return false;
	}

	/**
	 * Check if a teacher ID exists.
	 */
	public function checkById($teacherID) {
		$teacherID = $this->database->escape_string($teacherID);
		$sql = 'SELECT id FROM ' . Database::$tableTeachers . ' WHERE id = ' . $teacherID . ' LIMIT 1';
		return $this->database->query($sql)->num_rows > 0;
	}

	/**
	 * Check if a teacher name exists.
	 */
	public function checkByName($name) {
		$name = $this->database->escape_string($name);
		$sql = "SELECT name FROM " . Database::$tableTeachers . " WHERE name = '$name' LIMIT 1";
		return $this->database->query($sql)->num_rows > 0;
	}
}
?>