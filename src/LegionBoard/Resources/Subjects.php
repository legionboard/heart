<?php
/*
 * Copyright (C) 2016 Jan Weber
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

class Subjects extends AbstractResource
{

    public function __construct($user)
    {
        parent::__construct($user);
        $this->resource = 'subjects';
    }

    /**
     * Get one or more subjects.
     */
    public function get($id = null, $seeTimes = false)
    {
        $sql = "SELECT * FROM " . \LegionBoard\Database::$tableSubjects;
        // Add where clause for ID
        if (isset($id)) {
            $id = $this->database->escape_string($id);
            $sql .= " WHERE id LIKE '$id'";
        }
        $query = $this->database->query($sql);
        if (!$query || $query->num_rows == 0) {
            return null;
        }
        $subjects = array();
        while ($column = $query->fetch_array()) {
            $subject = array(
                            'id' => $column['id'],
                            'name' => $column['name'],
                            'shortcut' => $column['shortcut'],
                            'archived' => ($column['archived'] == '0') ? false : true,
                            'added' => $seeTimes ? $column['added'] : '-',
                            'edited' => $seeTimes ? $column['edited'] : '-'
                            );
            $subjects[] = $subject;
        }
        return $subjects;
    }

    /**
     * Create a subject.
     */
    public function create($name, $shortcut)
    {
        $name = $this->database->escape_string($name);
        $shortcut = $this->database->escape_string($shortcut);
        $sql = "INSERT INTO " . \LegionBoard\Database::$tableSubjects . " (name, shortcut) VALUES ('$name', '$shortcut')";
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
     * Update a subject.
     */
    public function update($id, $name, $shortcut, $archived)
    {
        $id = $this->database->escape_string($id);
        $name = $this->database->escape_string($name);
        $shortcut = $this->database->escape_string($shortcut);
        $archived = $this->database->escape_string($archived);
        $sql = "UPDATE " . \LegionBoard\Database::$tableSubjects . " SET name = '$name', shortcut = '$shortcut', archived = '$archived' WHERE id = '$id'";
        if ($this->database->query($sql)) {
            $this->activities->log($this->user, \LegionBoard\Activities::ACTION_UPDATE, $this->resource, $id);
            return true;
        }
        return false;
    }

    /**
     * Delete a subjects.
     */
    public function delete($id)
    {
        $id = $this->database->escape_string($id);
        $sql = "DELETE FROM " . \LegionBoard\Database::$tableSubjects . " WHERE id = '$id'";
        if ($this->database->query($sql)) {
            $this->activities->log($this->user, \LegionBoard\Activities::ACTION_DELETE, $this->resource, $id);
            return true;
        }
        return false;
    }

    /**
     * Check if a subject ID exists.
     */
    public function checkById($id)
    {
        $id = $this->database->escape_string($id);
        $sql = 'SELECT id FROM ' . \LegionBoard\Database::$tableSubjects . ' WHERE id = ' . $id . ' LIMIT 1';
        return $this->database->query($sql)->num_rows > 0;
    }

    /**
     * Check if a subject name exists.
     */
    public function checkByName($name)
    {
        $name = $this->database->escape_string($name);
        $sql = "SELECT name FROM " . \LegionBoard\Database::$tableSubjects . " WHERE name = '$name' LIMIT 1";
        return $this->database->query($sql)->num_rows > 0;
    }

    /**
     * Check if a subject shortcut exists.
     */
    public function checkByShortcut($shortcut)
    {
        $shortcut = $this->database->escape_string($shortcut);
        $sql = "SELECT name FROM " . \LegionBoard\Database::$tableSubjects . " WHERE shortcut = '$shortcut' LIMIT 1";
        return $this->database->query($sql)->num_rows > 0;
    }
}
