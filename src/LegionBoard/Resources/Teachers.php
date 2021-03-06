<?php
/*
 * Copyright (C) 2016 - 2017 Nico Alt
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * See the file "LICENSE.md" for the full license governing this code.
 */
namespace LegionBoard\Resources;

require_once __DIR__ . '/AbstractResource.php';

class Teachers extends AbstractResource
{

    public function __construct($user)
    {
        parent::__construct($user);
        $this->resource = 'teachers';
    }

    /**
     * Get one or more teachers.
     */
    public function get($teacherID = null, $seeTimes = false)
    {
        $sql = "SELECT * FROM " . \LegionBoard\Database::$tableTeachers;
        // Add where clause for ID
        if (isset($teacherID)) {
            $teacherID = $this->database->escape_string($teacherID);
            $sql .= " WHERE id LIKE '$teacherID'";
        }
        $query = $this->database->query($sql);
        if (!$query || $query->num_rows == 0) {
            return null;
        }
        $teachers = array();
        while ($column = $query->fetch_array()) {
            $teacher = array(
                            'id' => $column['id'],
                            'name' => $column['name'],
                            'subject' => $column['subject'],
                            'archived' => ($column['archived'] == '0') ? false : true,
                            'added' => $seeTimes ? $column['added'] : '-',
                            'edited' => $seeTimes ? $column['edited'] : '-'
                            );
            $teachers[] = $teacher;
        }
        return $teachers;
    }

    /**
     * Create a teacher.
     */
    public function create($name, $subject)
    {
        $name = $this->database->escape_string($name);
        $subject = $this->database->escape_string($subject);
        $sql = "INSERT INTO " . \LegionBoard\Database::$tableTeachers . " (name, subject) VALUES ('$name', '$subject')";
        if ($this->database->query($sql)) {
            $id = $this->database->insert_id;
            if ($this->activities->log($this->user, \LegionBoard\Activities::ACTION_CREATE, $this->resource, $id)) {
                return $id;
            }
            $this->delete($id);
        }
        return null;
    }

    /**
     * Update a teacher.
     */
    public function update($teacherID, $name, $subject, $archived)
    {
        $teacherID = $this->database->escape_string($teacherID);
        $name = $this->database->escape_string($name);
        $subject = $this->database->escape_string($subject);
        $archived = $this->database->escape_string($archived);
        $sql = "UPDATE " . \LegionBoard\Database::$tableTeachers . " SET name = '$name', subject = '$subject', archived = '$archived' WHERE id = '$teacherID'";
        if ($this->database->query($sql)) {
            $this->activities->log($this->user, \LegionBoard\Activities::ACTION_UPDATE, $this->resource, $teacherID);
            return true;
        }
        return false;
    }

    /**
     * Delete a teacher.
     */
    public function delete($teacherID)
    {
        $teacherID = $this->database->escape_string($teacherID);
        $sql = "DELETE FROM " . \LegionBoard\Database::$tableTeachers . " WHERE id = '$teacherID'";
        if ($this->database->query($sql)) {
            $this->activities->log($this->user, \LegionBoard\Activities::ACTION_DELETE, $this->resource, $teacherID);
            return true;
        }
        return false;
    }

    /**
     * Check if a teacher ID exists.
     */
    public function checkById($teacherID)
    {
        $teacherID = $this->database->escape_string($teacherID);
        $sql = 'SELECT id FROM ' . \LegionBoard\Database::$tableTeachers . ' WHERE id = ' . $teacherID . ' LIMIT 1';
        return $this->database->query($sql)->num_rows > 0;
    }

    /**
     * Check if a teacher name exists.
     */
    public function checkByName($name)
    {
        $name = $this->database->escape_string($name);
        $sql = "SELECT name FROM " . \LegionBoard\Database::$tableTeachers . " WHERE name = '$name' LIMIT 1";
        return $this->database->query($sql)->num_rows > 0;
    }
}
