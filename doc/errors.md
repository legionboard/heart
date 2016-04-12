# Errors

## General

All errors are returned in the following format:

```json
{
	"error": [
		{
			"code": "...",
			"message": "..."
		},
		...
	]
}
```
## Overview

Here are links to all errors that can occur.

### List teachers

No special errors are returned.

### Update teacher

* [200: The teacher could not get updated.](teachers/update.md#200-the-teacher-could-not-get-updated)

### Create teacher

* [300: The teacher could not get created.](teachers/create.md#300-the-teacher-could-not-get-created)
* [301: A teacher with the given name already exists.](teachers/create.md#301-a-teacher-with-the-given-name-already-exists)

### Deleting teacher

* [400: The teacher could not get deleted.](teachers/delete.md#400-the-teacher-could-not-get-deleted)
* [401: Deleting the teacher with ID 0 is not allowed.](teachers/delete.md#401-deleting-the-teacher-with-id-0-is-not-allowed)
* [402: The teacher is still linked to a change.](teachers/delete.md#402-the-teacher-is-still-linked-to-a-change)

### List changes

* [1100: The teacher may only contain an integer.](changes/list.md#11001102-the-covering-teacher-may-only-contain-an-integer)
* [1101: The teacher does not exist.](changes/list.md#11011103-the-covering-teacher-does-not-exist)
* [1102: The covering teacher may only contain an integer.](changes/list.md#11001102-the-covering-teacher-may-only-contain-an-integer)
* [1103: The covering teacher does not exist.](changes/list.md#11011103-the-covering-teacher-does-not-exist)
* [1104: The starting time is formatted badly.](changes/list.md#11041106-the-startingending-time-is-formatted-badly)
* [1105: The starting time does not exist.](changes/list.md#11051107-the-startingending-time-does-not-exist)
* [1106: The ending time is formatted badly.](changes/list.md#11041106-the-startingending-time-is-formatted-badly)
* [1107: The ending time does not exist.](changes/list.md#11051107-the-startingending-time-does-not-exist)
* [1108: The ending time has to be after the start time.](changes/list.md#1108-the-ending-time-has-to-be-after-the-start-time)

### Update change

* [1200: The change could not get updated.](changes/update.md#1200-the-change-could-not-get-updated)
* [1201: The starting time is formatted badly.](changes/update.md#12011202-the-startingending-time-is-formatted-badly)
* [1202: The ending time is formatted badly.](changes/update.md#12011202-the-startingending-time-is-formatted-badly)
* [1203: The starting time does not exist.](changes/update.md#12031204-the-startingending-time-does-not-exist)
* [1204: The ending time does not exist.](changes/update.md#12031204-the-startingending-time-does-not-exist)
* [1205: The teacher may only contain an integer.](changes/update.md#12051206-the-covering-teacher-may-only-contain-an-integer)
* [1206: The covering teacher may only contain an integer.](changes/update.md#12051206-the-covering-teacher-may-only-contain-an-integer)
* [1207: The type is not allowed.](changes/update.md#1207-the-type-is-not-allowed)
* [1208: The teacher does not exist.](changes/update.md#12081209-the-covering-teacher-does-not-exist)
* [1209: The covering teacher does not exist.](changes/update.md#12081209-the-covering-teacher-does-not-exist)
* [1210: The ending time has to be after the start time.](changes/update.md#1210-the-ending-time-has-to-be-after-the-start-time)
* [1211: The reason is not allowed.](changes/update.md#1211-the-reason-is-not-allowed)

### Create change

* [1300: The change could not get created.](changes/create.md#1300-the-change-could-not-get-created)
* [1301: The starting time is formatted badly.](changes/create.md#13011302-the-startingending-time-is-formatted-badly)
* [1302: The ending time is formatted badly.](changes/create.md#13011302-the-startingending-time-is-formatted-badly)
* [1303: The starting time does not exist.](changes/create.md#13031304-the-startingending-time-does-not-exist)
* [1304: The ending time does not exist.](changes/create.md#13031304-the-startingending-time-does-not-exist)
* [1305: The teacher may only contain an integer.](changes/create.md#13051306-the-covering-teacher-may-only-contain-an-integer)
* [1306: The covering teacher may only contain an integer.](changes/create.md#13051306-the-covering-teacher-may-only-contain-an-integer)
* [1307: The type is not allowed.](changes/create.md#1307-the-type-is-not-allowed)
* [1308: The teacher does not exist.](changes/create.md#13081309-the-covering-teacher-does-not-exist)
* [1309: The covering teacher does not exist.](changes/create.md#13081309-the-covering-teacher-does-not-exist)
* [1310: The ending time has to be after the start time.](changes/create.md#1310-the-ending-time-has-to-be-after-the-start-time)
* [1311: The reason is not allowed.](changes/create.md#1311-the-reason-is-not-allowed)

### Deleting change

* [1400: The change could not get deleted.](changes/delete.md#1400-the-change-could-not-get-deleted)